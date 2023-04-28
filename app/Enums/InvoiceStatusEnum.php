<?php

namespace App\Enums;

enum InvoiceStatusEnum: string
{
    case SETTLED = 'SETTLED';
    case PAID = 'PAID';
    case EXPIRED = 'EXPIRED';
    case FAILED = 'FAILED';
    case PENDING = 'PENDING';
}
