<?php

namespace App\Enums;

class VerificationStatuses extends Enum
{
    const REQUESTED = 1;
    const NEED_FOR_EDIT = 2;
    const EXPERT_REJECT = 3;

    const EXPERT_CONFIRMED = 4;
    const ADMIN_REJECT = 5;
    const ADMIN_CONFIRMED = 6;
}
