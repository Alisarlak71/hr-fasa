<?php

namespace App\Services\Sms;

class Memory implements Sms
{
    static array $memory = [];

    /**
     * @inheritDoc
     */
    public function send(string $cellphone, string $body): void
    {
        static::$memory[] = [
            'cellphone' => $cellphone,
            'body' => $body,
        ];
    }

    /**
     * @inheritDoc
     */
    public function otp(string $cellphone, string $token): void
    {
        static::$memory[] = [
            'cellphone' => $cellphone,
            'body' => $token,
        ];
    }

    /**
     * Get the last SMS sent to memory
     */
    public static function last(): array
    {
        return end(static::$memory);
    }
}
