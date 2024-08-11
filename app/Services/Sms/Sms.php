<?php

namespace App\Services\Sms;

interface Sms
{
    /**
     * Send SMS
     */
    public function send(string $cellphone, string $body): void;

    /**
     * Send OTP SMS
     */
    public function otp(string $cellphone, string $token): void;
}
