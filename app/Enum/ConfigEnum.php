<?php

namespace App\Enum;

use Illuminate\Validation\Rules\Enum;

class ConfigEnum extends Enum
{
    const DEPOSIT = 'DEPOSIT';
    const WITHDRAW = 'WITHDRAW';
    const TOW_FACTOR = 'TOW_FACTOR';

    const PAYMENT = 'PAYMENT';
}
