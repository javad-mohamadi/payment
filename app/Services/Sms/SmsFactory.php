<?php

namespace App\Services\Sms;

use Exception;

class SmsFactory
{
    /**
     * @throws Exception
     */
    public function make($adapter = ''): SmsServiceInterface
    {
        if ($adapter == '') {
            $adapter = config('sms.default');
        }

        return match ($adapter) {
            'kavenegar' => new KavehNegarSMSService(),
            default => new GhasedakSmsService(),
        };

    }
}

