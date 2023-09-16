<?php

namespace App\Enum;

Enum AccountTypeEnum: string
{
    case SYSTEM = 'system';
    case SHORT_TERM = 'short_term';
    case CHECKING = 'checking';
    case BUSINESS = 'business';
}
