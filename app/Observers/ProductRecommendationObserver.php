<?php

namespace App\Observers;

use App\Models\ProductRecommendation;
use Faker\Provider\Uuid;

class ProductRecommendationObserver
{
    /**
     * Handle the ProductRecommendation "created" event.
     *
     * @param  \App\Models\ProductRecommendation  $productRecommendation
     * @return void
     */
    public function creating(ProductRecommendation $productRecommendation)
    {
        $productRecommendation->id = Uuid::uuid();
    }
}
