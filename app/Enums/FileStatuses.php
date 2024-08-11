<?php

namespace App\Enums;

class FileStatuses extends Enum
{
    const ALL = 0;
    const UPLOADED = 1;
    const EXTRACTED = 2;
    const EXTRACTED_ERROR = 3;
    const IMPORTED = 4;
    const IMPORTED_ERROR = 5;
}
