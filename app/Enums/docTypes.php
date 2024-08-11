<?php

namespace App\Enums;

class docTypes extends Enum
{
    const types = [
        'meli' => 'کارت ملی',
        'sh' => 'شناسنامه',
        'edu' => 'تحصیلی',
        'cer' => 'گواهینامه',
        'etc' => 'سایر'
    ];
}
