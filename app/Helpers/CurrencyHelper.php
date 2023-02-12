<?php

namespace App\Helpers;

class CurrencyHelper
{
    /**
     * convert to rupiah currency
     *
     * @param float $number
     *
     * @return string
     */

    public static function rupiahCurrency(float $number): string
    {
        return "Rp " . number_format($number, 2, ',', '.');
    }
}
