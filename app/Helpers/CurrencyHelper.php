<?php

namespace App\Helpers;

class CurrencyHelper
{
    /**
     * Count Price After Discount
     *
     * @param float $price
     * @param float $discount
     * @param bool $formatted
     *
     * @return float|string
     */

    public static function countPriceAfterDiscount(float $price, float $discount, bool $formatted = false): float|string
    {
        $total = $price - ($price * ($discount / 100));

        if ($formatted) {
            return self::rupiahCurrency($total);
        }

        return $total;
    }

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
