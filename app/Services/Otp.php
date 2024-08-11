<?php

namespace App\Services;

use App\Services\Utils\Random;
use Illuminate\Support\Facades\Redis;

class Otp
{
    private Random $random;

    public function __construct(Random $random)
    {
        $this->random = $random;
    }

    public function ttl(string $cellphone): int
    {
        return intval(Redis::connection('otp')->client()->ttl('mobile:' . $cellphone));
    }

    public function generate(string $cellphone): int
    {
        $otp = $this->random->numeric(100000, 999999);
        $key = 'mobile:' . $cellphone;

        Redis::connection('otp')->client()->set($key, $otp, $this->expiresAfter());

        return $otp;
    }

    public function check(string $cellphone, int $token): bool
    {
        return $token == Redis::connection('otp')->client()->get('mobile:' . $cellphone);
    }

    public function expiresAfter(): int
    {
        return config('context.auth.otp.ttl');
    }
}
