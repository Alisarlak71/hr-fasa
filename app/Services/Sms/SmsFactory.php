<?php

namespace App\Services\Sms;

class SmsFactory
{
    public function create(string $driver): Sms
    {
        return match ($driver) {
            'kavehnegar' => new KavehNegar(),
            'Magfa' => new Magfa(),
            'memory' => new Memory(),
            default => new Log(),
        };
    }
}
