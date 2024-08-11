<?php

namespace App\Enums;

class OrderStatuses extends Enum
{
    const ALL = 0;
    const WAIT_FOR_PAYMENT = 1;
    const CANCELED = 2;
    const COMPLETED = 3;
    const CONFIRMED = 4;
}
