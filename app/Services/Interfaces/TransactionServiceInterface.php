<?php

namespace App\Services\Interfaces;

interface TransactionServiceInterface
{
    public function create(array $data);

    public function getThreeMostTransactions();
}
