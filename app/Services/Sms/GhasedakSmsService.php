<?php

namespace App\Services\Sms;

class GhasedakSmsService implements SmsServiceInterface
{
    private string $sender;

    private string $apiKey;

    public function __construct()
    {
        $this->sender = config('sms.providers.ghasedak.sender');
        $this->apiKey = config('sms.providers.ghasedak.api_key');
    }

    public function send(string $receptor, string $message)
    {
        dd('implement ghasedak');
    }
}
