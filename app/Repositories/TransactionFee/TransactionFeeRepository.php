<?php

namespace App\Repositories\TransactionFee;

use App\Models\TransactionFee;
use App\Repositories\Repository;

class TransactionFeeRepository extends Repository implements TransactionFeeRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return TransactionFee::class;
    }
}
