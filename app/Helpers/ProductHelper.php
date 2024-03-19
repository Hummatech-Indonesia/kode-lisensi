<?php

namespace App\Helpers;

use App\Enums\ProductStatusEnum;
use App\Models\Product;
use Illuminate\View\View;
use Jorenvh\Share\Share;
use Illuminate\Support\Facades\URL;
use App\Enums\UserRoleEnum;


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

    public static function shareButtons(string $slug)
    {
        $share = new Share();
        $shareButtons = $share->page(URL::to('/products/' . $slug))
        ->whatsapp()
        ->facebook()
        ->telegram()
        ->getRawLinks();
        return $shareButtons;
    }

}
