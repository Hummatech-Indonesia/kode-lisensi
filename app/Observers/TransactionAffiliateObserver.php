<?php

namespace App\Observers;

use App\Models\TransactionAffiliate;
use Faker\Provider\Uuid;

class TransactionAffiliateObserver
{
    /**
     * Handle the TransactionAffiliate "created" event.
     *
     * @param  \App\Models\TransactionAffiliate  $transactionAffiliate
     * @return void
     */
    public function creating(TransactionAffiliate $transactionAffiliate)
    {
        $transactionAffiliate->id = Uuid::uuid();
    }
}
