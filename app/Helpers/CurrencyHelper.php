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

    public static function countPriceAfterDiscount(float $price, float $discount, bool $formatted = false, int $discount_price = null): float|string
    {
        if ($discount_price == 1) {
            $total = $price - $discount;
        } else {
            $total = $price - ($price * ($discount / 100));
        }

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
        return "Rp " . number_format($number, 0, ',', '.');
    }

    /**
     * Count Price After Tax
     *
     * @param float $price
     * @param float $tax
     * @param bool $formatted
     *
     * @return float|string
     */

    public static function countPriceAfterTax(float $price, float $tax, bool $formatted = false): float|string
    {
        $total = $price + self::countProductTax($price, $tax);

        if ($formatted) {
            return self::rupiahCurrency($total);
        }

        return $total;
    }

    /**
     * Count product tax
     *
     * @param float $price
     * @param float $tax
     * @return float|string
     */

    public static function countProductTax(float $price, float $tax): float|string
    {
        return ($price * ($tax / 100));
    }

    public static function varianPrice(mixed $varianProducts)
    {
        $minSellPrice = PHP_INT_MAX; // Inisialisasi dengan nilai maksimum PHP_INT_MAX

        foreach ($varianProducts as $varianProduct) {
            $minSellPrice = min($minSellPrice, $varianProduct->sell_price);
        }

        return $minSellPrice;
    }
    public static function varianPriceMax(mixed $varianProducts)
    {
        $maxSellPrice = PHP_INT_MIN; // Inisialisasi dengan nilai minimum PHP_INT_MIN

        foreach ($varianProducts as $varianProduct) {
            $maxSellPrice = max($maxSellPrice, $varianProduct->sell_price);
        }

        return $maxSellPrice;
    }
}
