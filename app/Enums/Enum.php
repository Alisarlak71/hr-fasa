<?php

namespace App\Enums;

use Illuminate\Support\Arr;
use ReflectionClass;
use Throwable;

class Enum
{
    protected static array $items = [];

    public static function values(): array
    {
        try {
            if (isset(static::$items[static::class])) {
                return array_values(static::$items[static::class]);
            }

            return array_values(static::$items[static::class] = (new ReflectionClass(static::class))->getConstants());
        } catch (Throwable $e) {
            return [];
        }
    }

    public static function validation(): string
    {
        return 'in:' . implode(',', static::values());
    }

    public static function randomValue()
    {
        return Arr::random(static::values());
    }
}
