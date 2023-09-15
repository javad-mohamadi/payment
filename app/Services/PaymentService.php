<?php

namespace App\Services;

use Exception;
use App\Enum\BankEnum;
use App\Models\Account;
use App\Models\Transfer;
use App\Enum\TransferEnum;
use App\Models\Transaction;
use App\Enum\TransactionEnum;
use App\DTOs\Payment\TransferDto;
use Illuminate\Support\Facades\DB;
use App\Events\TransferSendSmsEvent;
use App\Services\Interfaces\CardServiceInterface;
use App\Services\Interfaces\PaymentServiceInterface;
use App\Services\Interfaces\AccountServiceInterface;
use App\Services\Interfaces\TransferServiceInterface;
use App\Services\Interfaces\TransactionServiceInterface;
use App\Services\Interfaces\TransactionFeeServiceInterface;
use App\Services\Interfaces\CardDynamicPasswordServiceInterface;

class PaymentService implements PaymentServiceInterface
{
    public function __construct(
        private readonly TransactionServiceInterface         $transactionService,
        private readonly TransferServiceInterface            $transferService,
        private readonly AccountServiceInterface             $accountService,
        private readonly CardServiceInterface                $cardService,
        private readonly CardDynamicPasswordServiceInterface $cardDynamicPasswordService,
        private readonly TransactionFeeServiceInterface      $feeService,
    )
    {
    }

    /**
     * @throws Exception
     */
    public function transfer(TransferDto $dto): string
    {
        $destCard = $this->cardService->findByCardNumber($dto->destCardNumber);
        $transfer = $this->saveTransfer($dto, $destCard->id ?? null);

        DB::beginTransaction();
        try {
            $transferFee = config('transfer.fee');
            $sourceCard = $this->cardService->find($dto->sourceCardId);
            $sourceAccount = $this->accountService->lockForUpdate($sourceCard->account);

            $this->checkUserIsCardOwner($sourceAccount, $dto->userId);
            $this->cardService->checkCvv2($sourceCard, $dto->cvv2);
            $passwordType = $this->cardDynamicPasswordService->checkPassword($sourceCard, $dto);
            $this->accountService->checkAccountBalance($sourceAccount, $sourceCard, $dto->amount, $passwordType);

            $destAccount = null;
            if ($destCard) {
                $destAccount = $this->accountService->lockForUpdate($destCard->account);
            }

            $sourceTransaction = $this->saveTransaction($sourceAccount->id, $transfer->id, $dto->amount, TransactionEnum::WITHDRAW);
            $feeTransaction = $this->saveTransaction($sourceAccount->id, $transfer->id, $transferFee, TransactionEnum::WITHDRAW);

            $sourceAmount = $dto->amount + $transferFee;
            $this->accountService->withdraw($sourceAccount, $sourceAmount);

            if ($destAccount) {
                $destTransaction = $this->saveTransaction($destAccount->id, $transfer->id, $dto->amount, TransactionEnum::DEPOSIT);
                $this->accountService->deposit($destAccount, $dto->amount);
            } else {
                //toDo implement Shetab service
                return 'in this situation we need Shetab API';
            }

            $systemAccount = $this->accountService->findSystemAccount();
            $this->saveFeeTransaction($systemAccount->id, $transfer->id);

            $this->accountService->deposit($systemAccount, $transferFee);

            $this->transferService->updateStatus($transfer->id, TransferEnum::SUCCESS);
            DB::commit();

            $data = $this->prepareSmsData($sourceAccount, $destAccount, $sourceTransaction, $dto);
            event(new TransferSendSmsEvent($data));
        } catch (Exception $exception) {
            DB::rollBack();
            $this->transferService->updateStatus($transfer->id, TransferEnum::FAILED);

            throw new Exception($exception->getMessage());
        }

        return 'Transfer amount has been successfully';
    }

    private function checkUserIsCardOwner(Account $account, int $userId): void
    {
        if ($account->user_id != $userId) {
            throw new Exception('You dont have access to this card');
        }
    }

    private function saveTransfer(TransferDTO $dto, ?int $destCardId): Transfer
    {
        $destCardPreNum = substr($dto->destCardNumber, 0, 4);
        $data = [
            'source_card_id'   => $dto->sourceCardId,
            'dest_card_id'     => $destCardId,
            'dest_card_number' => $dto->destCardNumber,
            'dest_bank'        => BankEnum::getBanks()[$destCardPreNum]->value,
            'amount'           => $dto->amount,
        ];

        return $this->transferService->create($data);
    }

    private function saveTransaction(int $accountId, int $transferId, int $amount, TransactionEnum $type): Transaction
    {
        $data = [
            'account_id'  => $accountId,
            'transfer_id' => $transferId,
            'amount'      => $amount,
            'type'        => $type->value,
        ];

        return $this->transactionService->create($data);
    }

    private function saveFeeTransaction(int $systemAccountId, int $transferId): void
    {
        $data = [
            'transfer_id'     => $transferId,
            'amount'          => config('transfer.fee'),
            'bank_account_id' => $systemAccountId,
        ];

        $this->feeService->create($data);
    }

    private function prepareSmsData(
        Account     $sourceAccount,
        ?Account    $destAccount,
        Transaction $transaction,
        TransferDto $dto
    ) {
        return [
            'source_mobile'         => $sourceAccount->user->mobile,
            'source_account_number' => $sourceAccount->number,
            'source_user_id'        => $sourceAccount->user_id,
            'dest_mobile'           => $destAccount->user->mobile ?? null,
            'dest_account_number'   => $destAccount->number ?? null,
            'dest_user_id'          => $destAccount->user_id ?? null,
            'amount'                => $dto->amount,
            'date'                  => $transaction->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
