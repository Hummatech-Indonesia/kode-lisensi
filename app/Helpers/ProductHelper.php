<?php

namespace App\Helpers;

use App\Enums\ProductStatusEnum;
use App\Models\Product;

class ProductHelper
{

    /**
     * Handle count stocking products
     *
     * @return int
     */

    public static function countStockingProducts(): int
    {
        return Product::query()
            ->where('status', [ProductStatusEnum::AVAILABLE->value])
            ->count();
    }

    /**
     * Handle count preorder products
     *
     * @return int
     */

    public static function countPreorderProducts(): int
    {
        return Product::query()
            ->where('status', [ProductStatusEnum::PREORDER->value])
            ->count();
    }

    /**
     * Handle count all products
     *
     * @return int
     */

    public static function countProducts(): int
    {
        return Product::query()->count();
    }
}
