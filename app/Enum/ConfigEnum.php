<?php

namespace App\Enum;

Enum ConfigEnum: string
{
    case DEPOSIT = 'deposit';
    case WITHDRAW = 'withdraw';
    case TWO_FACTOR = 'two_factor';
    case PAYMENT = 'payment';
}
