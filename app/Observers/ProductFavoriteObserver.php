<?php

namespace App\Observers;

use App\Models\ProductFavorite;
use Faker\Provider\Uuid;

class ProductFavoriteObserver
{
    /**
     * Handle the ProductFavorite "created" event.
     *
     * @param  \App\Models\ProductFavorite  $productFavorite
     * @return void
     */
    public function creating(ProductFavorite $productFavorite)
    {
        $productFavorite->id = Uuid::uuid();
    }
}
