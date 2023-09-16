<?php

return [
    'payment' => [
        'min_transfer_amount' => env('MIN_TRANSFER_AMOUNT', 10000),
        'max_transfer_amount' => env('MAX_TRANSFER_AMOUNT', 500000000),
    ],

    'limit_dynamic_password_transfer' => env('LIMIT_DYNAMIC_PASSWORD_TRANSFER', 500000000),

    'limit_static_password_transfer' => env('LIMIT_STATIC_PASSWORD_TRANSFER', 1000000),

    'fee' => env('TRANSFER_FEE', 5000),

    'dynamic_password_expire_time' => env('DYNAMIC_PASSWORD_EXPIRE_TIME', 120),
];
