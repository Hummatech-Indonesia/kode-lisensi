<?php

namespace App\Observers;

use App\Models\ShareProductReseller;
use Faker\Provider\Uuid;

class ShareProductReselllerObserver
{
    /**
     * Handle the ShareProductReseller "created" event.
     *
     * @param  \App\Models\ShareProductReseller  $shareProductReseller
     * @return void
     */
    public function creating(ShareProductReseller $shareProductReseller)
    {
        $shareProductReseller->id = Uuid::uuid();
    }
}
