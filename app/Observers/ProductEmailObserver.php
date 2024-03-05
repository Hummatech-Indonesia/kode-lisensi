<?php

namespace App\Observers;

use App\Models\ProductEmail;
use Faker\Provider\Uuid;

class ProductEmailObserver
{
    /**
     * Handle the VarianProduct "created" event.
     *
     * @param  \App\Models\ProductEmail  $varianProduct
     * @return void
     */
    public function creating(ProductEmail $productEmail)
    {
        $productEmail->id = Uuid::uuid();
    }

}
