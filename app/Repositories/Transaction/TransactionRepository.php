<?php

namespace App\Repositories\Transaction;

use App\Models\Transaction;
use App\Repositories\Repository;

class TransactionRepository extends Repository implements TransactionRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Transaction::class;
    }
}
