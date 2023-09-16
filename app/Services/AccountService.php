<?php

namespace App\Services;

use Exception;
use App\Models\Card;
use App\Models\Account;
use App\Enum\PasswordTypeEnum;
use Illuminate\Support\Collection;
use App\Criteria\FindAccountSystemCriteria;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Services\Interfaces\AccountServiceInterface;
use Prettus\Repository\Exceptions\RepositoryException;
use App\Repositories\Account\AccountRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AccountService implements AccountServiceInterface
{
    /**
     * @param AccountRepositoryInterface $repository
     */
    public function __construct(protected AccountRepositoryInterface $repository)
    {
    }

    /**
     * @param int $id
     * @return LengthAwarePaginator|Collection|mixed
     */
    function find(int $id): mixed
    {
        return $this->repository->find($id);
    }

    /**
     * @param int $userId
     * @return Account
     */
    public function findByUser(int $userId): Account
    {
        return $this->repository->findByField('user_id', $userId);
    }

    public function lockForUpdate(Account $account)
    {
        return $this->repository->lockForUpdate($account);
    }

    /**
     * @throws RepositoryException
     */
    public function findSystemAccount(): Account
    {
        return $this->repository->pushCriteria(new FindAccountSystemCriteria())->first();
    }

    public function checkAccountBalance(Account $account, Card $card, int $amount, PasswordTypeEnum $passwordType): void
    {
        if ($account->balance < $amount + config('transfer.fee')) {
            throw new Exception('limit of balance');
        }

        if ($passwordType->value == PasswordTypeEnum::DYNAMIC->value) {
            if ($amount > $card->limit_dynamic_password_transfer) {
                throw new Exception('limit of transfer daily');
            }
        } else {
            if ($amount > $card->limit_static_password_transfer) {
                throw new Exception('limit of transfer daily');
            }
        }
    }

    /**
     * @param Account $account
     * @param int $amount
     * @return void
     * @throws ValidatorException
     */
    public function deposit(Account $account, int $amount): void
    {
        $newBalance = $account->balance + $amount;
        $this->update($account->id, ['balance' => $newBalance]);
    }

    /**
     * @param Account $account
     * @param int $amount
     * @return void
     * @throws ValidatorException
     */
    public function withdraw(Account $account, int $amount): void
    {
        $newBalance = $account->balance - $amount;
        $this->update($account->id, ['balance' => $newBalance]);
    }

    /**
     * @param int $id
     * @param array $data
     * @return void
     * @throws ValidatorException
     */
    public function update(int $id, array $data): void
    {
        $this->repository->update($data, $id);
    }
}
