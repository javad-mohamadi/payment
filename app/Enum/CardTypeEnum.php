<?php

namespace App\Enum;

Enum CardTypeEnum: string
{
    case CREDIT_CARD = 'credit';
    case GIFT_CARD = 'gift';
    case SMART_CARD = 'smart';
    case DEBIT_CARD = 'debit';
}
