<?php

namespace App\Observers;

use App\Models\VarianProduct;
use Faker\Provider\Uuid;
use Illuminate\Support\Str;

class VarianProductObserver
{
    /**
     * Handle the VarianProduct "created" event.
     *
     * @param  \App\Models\VarianProduct  $varianProduct
     * @return void
     */
    public function creating(VarianProduct $varianProduct)
    {
        $varianProduct->id = Uuid::uuid();
        $varianProduct->slug = Str::slug($varianProduct->name);
    }
}
