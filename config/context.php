<?php

return [
    'auth' => [
        'otp' => [
            'ttl' => intval(env('OTP_TTL', 120)),
        ],
    ],
    'sms' => [
        'driver' => env('SMS_DRIVER', 'log'),
        'drivers' => [
            'candoo' => [
                'endpoint' => env('SMS_CANDOO_ENDPOINT', 'https://my.candoosms.com'),
                'username' => env('SMS_CANDOO_USERNAME'),
                'password' => env('SMS_CANDOO_PASSWORD'),
                'source' => env('SMS_CANDOO_SOURCE'),
                'flash' => env('SMS_CANDOO_FLASH', 0),
            ],
            'kavehnegar' => [
                'url' => env('KAVEHNEGAR_URL', 'https://api.kavenegar.com'),
                'sender' => env('KAVEHNEGAR_SENDER', '10008663'),
                'token' => env('KAVEHNEGAR_TOKEN'),
                'timeout' => env('KAVEHNEGAR_TIMEOUT', 10),
            ],
            'magfa' => [
                'url' => env('MAGFA_URL', 'https://sms.magfa.com/api/http/sms/v2/'),
                'sender' => env('MAGFA_SENDER', '300084615'),
                'password' => env('MAGFA_PASSWORD'),
                'username' => env('MAGFA_USERNAME'),
                'domain' => env('MAGFA_DOMAIN','fasa'),
            ],
            'tekye' => [
                'url' => env('KAVEHNEGAR_URL', 'https://api.kavenegar.com'),
                'sender' => env('KAVEHNEGAR_TEKYE_SENDER', '10004552'),
                'token' => env('KAVEHNEGAR_TEKYE_TOKEN'),
                'timeout' => env('KAVEHNEGAR_TIMEOUT', 10),
            ],
        ],
    ],
];
