<?php

namespace App\Services;

use App\Criteria\GetUsersTransactionsCriteria;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Interfaces\TransactionServiceInterface;
use App\Services\Interfaces\BackofficeUserServiceInterface;
use App\Services\Interfaces\BackofficeUserServiceInterface;
use App\Services\Interfaces\TransactionServiceInterface;

class BackofficeUserService implements BackofficeUserServiceInterface
{
    public function __construct(
        protected UserRepositoryInterface $repository,
        protected TransactionServiceInterface $transactionService,
    ) {
    }

    public function getTopThreeUsersTransactions()
    {
        $userIds = $this->transactionService->getThreeMostTransactions();

        return $this->repository->pushCriteria(new GetUsersTransactionsCriteria($userIds))->get();
    }
}
