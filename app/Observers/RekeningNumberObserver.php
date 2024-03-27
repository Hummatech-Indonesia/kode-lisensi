<?php

namespace App\Observers;

use App\Models\ProductRecommendation;
use App\Models\RekeningNumber;
use Faker\Provider\Uuid;
use Illuminate\Support\Facades\Auth;

class RekeningNumberObserver
{
    /**
     * Handle the ProductRecommendation "created" event.
     *
     * @param  \App\Models\rekeningNumber  $rekeningNumber
     * @return void
     */
    public function creating(RekeningNumber $rekeningNumber)
    {
        $rekeningNumber->id = Uuid::uuid();
        $rekeningNumber->user_id=Auth::id();
    }
    public function updating(RekeningNumber $rekeningNumber){
        $rekeningNumber->id=Uuid::uuid();
        $rekeningNumber->user_id=Auth::id();
    }
}
