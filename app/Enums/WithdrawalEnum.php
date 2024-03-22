<?php

namespace App\Enums;

enum WithdrawalEnum: string
{
    case BLUEBCA = 'bluebca';
    case DANA = 'dana';
    case OVO = 'ovo';
    case GOPAY = 'gopay';
}
