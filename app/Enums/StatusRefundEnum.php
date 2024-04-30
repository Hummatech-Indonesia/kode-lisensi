<?php

namespace App\Enums;

enum StatusRefundEnum: string
{
    case ACCEPTED = 'accepted';
    case PENDING = 'pending';
    case REJECT = 'reject';
}
