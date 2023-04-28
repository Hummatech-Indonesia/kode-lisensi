<?php

namespace App\Enums;

enum LicenseStatusEnum: string
{
    case PROCESSED = 'PROCESSED';
    case COMPLETED = 'COMPLETED';
    case PENDING = 'PENDING';
    case CANCELED = 'CANCELED';
}
