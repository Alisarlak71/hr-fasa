<?php

namespace App\Services\Utils;

use Exception;
use Illuminate\Support\Str;

class Random
{
    public function numeric(int $min, int $max): int
    {
        try {
            return random_int($min, $max);
        } catch (Exception) {
            return mt_rand($min, $max);
        }
    }

    public function alphabetic(int $length): string
    {
        try {
            return bin2hex(random_bytes($length / 2));
        } catch (Exception) {
            return Str::random($length);
        }
    }

    function cellphone(): string
    {
        try {
            return '+989' . random_int(100000000, 999999999);
        } catch (Exception) {
            return '+989' . mt_rand(100000000, 999999999);
        }
    }

    function password(): string
    {
        $str = 'abcdefghijklmnopqrstuvwzyz';
        $str1 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str2 = '0123456789';
        $str3 = '!@#$%^&*';
        $s = str_shuffle($str);
        $s1 = str_shuffle($str1);
        $s2 = str_shuffle($str2);
        $s3 = str_shuffle($str3);
        $total = substr($s, 0, 3) . substr($s1, 0, 3) . substr($s2, 0, 3) . substr($s3, 0, 3);

        return str_shuffle($total);
    }
}
