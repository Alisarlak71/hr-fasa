<?php

namespace App\Services\Sms;

class Log implements Sms
{
    /**
     * @inheritDoc
     */
    public function send(string $cellphone, string $body): void
    {
        $message = "Logging SMS (To $cellphone) \n$body";
        \Illuminate\Support\Facades\Log::debug($message);
    }

    public function otp(string $cellphone, string $token): void
    {
        $message = "Logging SMS (To $cellphone) \n$token";
        \Illuminate\Support\Facades\Log::debug($message);
    }
}
