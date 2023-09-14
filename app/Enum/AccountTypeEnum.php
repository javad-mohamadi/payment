<?php

namespace App\Enum;

use Illuminate\Validation\Rules\Enum;

class AccountTypeEnum extends Enum
{
    const SAVING = 'SAVING';
    const SHORT_TERM = 'SHORT_TERM';
    const CHECKING = 'CHECKING';
    const BUSINESS = 'BUSINESS';
}
