<?php

namespace App\Services;

use App\Models\Transaction;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Services\Interfaces\TransactionServiceInterface;
use App\Criteria\GetThreeMostTransactionsUserIdsCriteria;
use App\Repositories\Transaction\TransactionRepositoryInterface;

class TransactionService implements TransactionServiceInterface
{
    /**
     * @param TransactionRepositoryInterface $repository
     */
    public function __construct(protected TransactionRepositoryInterface $repository)
    {
    }

    /**
     * @param array $data
     * @return Transaction
     * @throws ValidatorException
     */
    public function create(array $data): Transaction
    {
        return $this->repository->create($data);
    }

    public function getThreeMostTransactions()
    {
        return $this->repository->pushCriteria(new GetThreeMostTransactionsUserIdsCriteria())->get();
    }
}
