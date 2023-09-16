<?php

return [

    'default'   => env('SMS_PROVIDER', 'ghasedak'),
    'providers' => [
        'ghasedak'   => [
            'api_key' => env('SMS_GHASEDAK_APIKEY', 'test'),
            'sender'  => env('SMS_GHASEDAK_SENDER', 'test'),
        ],
        'kavenegar' => [
            'url'     => env('SMS_KAVENEGAR_GATEWAY', 'http://api.kavenegar.com/v1/%s/%s/%s.json/'),
            'sender'  => env('SMS_KAVENEGAR_SENDER', 'test'),
            'api_key' => env('SMS_KAVENEGAR_APIKEY', 'test'),
        ]
    ]
];
