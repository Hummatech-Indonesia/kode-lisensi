<?php

namespace App\Enums;

enum UsedForEnum: string
{
    case BUYPRODUCT = 'buy_product';
    case PAYRESELLER = 'pay_reseller';
    case REFUND = 'refund';
    case OTHERS = 'others';
}
