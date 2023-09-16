<?php

namespace App\Services\Interfaces;

use App\Models\Card;
use App\Models\Account;
use App\Enum\PasswordTypeEnum;

interface AccountServiceInterface
{
    public function find(int $id);

    public function findByUser(int $userId);

    public function lockForUpdate(Account $account);

    public function findSystemAccount(): Account;

    public function checkAccountBalance(Account $account, Card $card, int $amount, PasswordTypeEnum $passwordType): void;

    public function deposit(Account $account, int $amount);

    public function withdraw(Account $account, int $amount);
}
