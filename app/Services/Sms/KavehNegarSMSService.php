<?php

namespace App\Services\Sms;

use Kavenegar\KavenegarApi;

class KavehNegarSMSService implements SmsServiceInterface
{
    private readonly string $sender;

    private readonly string $apiKey;

    public function __construct()
    {
        $this->sender = config('sms.providers.kavenegar.sender');
        $this->apiKey = config('sms.providers.kavenegar.api_key');
    }

    public function send(string $receptor, string $message): void
    {
        $kavehnegar = new KavenegarApi($this->apiKey);
        $kavehnegar->Send($this->sender, $receptor, $message);
    }
}
