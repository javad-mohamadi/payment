<?php

namespace App\Services\Sms;

use Illuminate\Support\Facades\Facade;

class Sms extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'sms';
    }
}
