<?php

namespace App\Observers;

use App\Models\Product;
use Faker\Provider\Uuid;

class ProductObserver
{
    /**
     * Handle the Product "creating" event.
     *
     * @param Product $product
     * @return void
     */
    public function creating(Product $product): void
    {
        $product->id = Uuid::uuid();
    }


}
