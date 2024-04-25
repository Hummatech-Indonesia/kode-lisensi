<?php

namespace App\Enums;

enum UsedForEnum: string
{
    case BUYPRODUK = 'buy_produk';
    case PAYRESELLER = 'pay_reseller';
    case OTHERS = 'others';
}
