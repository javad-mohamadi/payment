<?php

namespace App\Enum;

Enum TransactionEnum: string
{
    case DEPOSIT = 'deposit';
    case WITHDRAW = 'withdraw';
    case FEE = 'fee';
}
