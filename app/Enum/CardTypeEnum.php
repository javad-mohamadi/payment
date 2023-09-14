<?php

namespace App\Enum;

use Illuminate\Validation\Rules\Enum;

class CardTypeEnum extends Enum
{
    const CREDIT_CARD = 'CREDIT';
    const GIFT_CARD = 'GIFT';
    const SMART_CARD = 'SMART';
    const DEBIT_CARD = 'DEBIT';
}
