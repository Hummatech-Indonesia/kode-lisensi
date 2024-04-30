<?php

namespace App\Observers;

use App\Models\Refund;
use Faker\Provider\Uuid;

class RefundObserver
{
    /**
     * Handle the Refund "created" event.
     *
     * @param  \App\Models\Refund  $refund
     * @return void
     */
    public function creating(Refund $refund)
    {
        $refund->id = Uuid::uuid();
    }

    /**
     * Handle the Refund "updated" event.
     *
     * @param  \App\Models\Refund  $refund
     * @return void
     */
    public function updated(Refund $refund)
    {
        //
    }

    /**
     * Handle the Refund "deleted" event.
     *
     * @param  \App\Models\Refund  $refund
     * @return void
     */
    public function deleted(Refund $refund)
    {
        //
    }

    /**
     * Handle the Refund "restored" event.
     *
     * @param  \App\Models\Refund  $refund
     * @return void
     */
    public function restored(Refund $refund)
    {
        //
    }

    /**
     * Handle the Refund "force deleted" event.
     *
     * @param  \App\Models\Refund  $refund
     * @return void
     */
    public function forceDeleted(Refund $refund)
    {
        //
    }
}
