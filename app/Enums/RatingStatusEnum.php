<?php

namespace App\Enums;

enum RatingStatusEnum: string
{
    case APPROVED = 'APPROVED';
    case DECLINED = 'DECLINED';
}
