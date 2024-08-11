<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;

class Cellphone implements ValidationRule
{

    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        if (!preg_match('/^09[0-9]{9}$/', $value)) {
            $fail(trans('validation.regex'));
        }
    }
}