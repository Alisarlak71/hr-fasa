<?php

use App\Enums\OrderStatuses;

function getStatusLabel($status): string
{
    return match ($status) {
        OrderStatuses::WAIT_FOR_PAYMENT => 'منتظر پرداخت',
        OrderStatuses::CANCELED => 'لغو شده',
        OrderStatuses::COMPLETED => 'تکمیل شده',
        OrderStatuses::CONFIRMED => 'تایید شده',
        default => 'ناشناخته',
    };
}

function getStatusBadgeClass($status): string
{
    return match ($status) {
        OrderStatuses::WAIT_FOR_PAYMENT => 'badge-warning',
        OrderStatuses::CANCELED => 'badge-danger',
        OrderStatuses::COMPLETED => 'badge-success',
        OrderStatuses::CONFIRMED => 'badge-info',
        default => 'badge-secondary',
    };
}