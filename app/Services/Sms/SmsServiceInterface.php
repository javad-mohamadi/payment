<?php

namespace App\Services\Sms;

interface SmsServiceInterface
{
    public function send(string $receptor ,string $message);
}
