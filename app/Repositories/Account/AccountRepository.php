<?php

namespace App\Repositories\Account;

use App\Models\Account;
use App\Repositories\Repository;

class AccountRepository extends Repository implements AccountRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Account::class;
    }
}
