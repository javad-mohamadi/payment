<?php

namespace App\Services;

use Exception;
use App\Models\Card;
use App\Enum\PasswordTypeEnum;
use App\DTOs\Payment\TransferDTO;
use Illuminate\Support\Facades\Hash;
use App\Services\Interfaces\CardServiceInterface;
use App\Criteria\FindActiveDynamicPasswordCriteria;
use App\Services\Interfaces\CardDynamicPasswordServiceInterface;
use App\Criteria\DeleteUsedAndExpiredCardDynamicPasswordCriteria;
use App\Repositories\CardDynamicPassword\CardDynamicPasswordRepository;

class CardDynamicPasswordService implements CardDynamicPasswordServiceInterface
{

    public function __construct(
        private readonly CardDynamicPasswordRepository $cardDynamicPasswordRepository,
        private readonly CardServiceInterface          $cardService
    ) {
    }

    public function checkPassword(Card $card, TransferDTO $dto): PasswordTypeEnum
    {
        $time = now()->subSeconds(config('transfer.dynamic_password_expire_time'));
        $dynamicPassword = $this->cardDynamicPasswordRepository
            ->pushCriteria(new FindActiveDynamicPasswordCriteria(
                $card->id,
                $dto->destCardNumber,
                $dto->amount,
                $time
            ))->first();

        $otp = $dynamicPassword->otp ?? null;
        if ($dto->amount > config('transfer.limit_static_password_transfer')) {
            if (!Hash::check($dto->password, $otp)) {
                throw new Exception('wrong password!');
            }

            $this->cardDynamicPasswordRepository->update(['used' => true], $dynamicPassword->id);

            return PasswordTypeEnum::DYNAMIC;
        }

        $staticPassword = $card->static_second_password;
        if (!Hash::check($dto->password, $otp) && !Hash::check($dto->password, $staticPassword)) {
            throw new Exception('wrong password!');
        }

        $passwordType = PasswordTypeEnum::STATIC;
        if (Hash::check($dto->password, $otp)) {
            $this->cardDynamicPasswordRepository->update(['used' => true], $dynamicPassword->id);
            $passwordType = PasswordTypeEnum::DYNAMIC;
        }

        if ($passwordType == PasswordTypeEnum::STATIC) {
            $limitStaticPasswordTransfer = config('transfer.limit_static_password_transfer') - $dto->amount;
            $this->cardService->update($card->id, ['limit_static_password_transfer' => $limitStaticPasswordTransfer]);
        }

        return $passwordType;
    }

    public function removeUsedPassword(): void
    {
        $time = now()->subSeconds(config('transfer.dynamic_password_expire_time'));
        $this->cardDynamicPasswordRepository->pushCriteria(new DeleteUsedAndExpiredCardDynamicPasswordCriteria($time));
    }
}
