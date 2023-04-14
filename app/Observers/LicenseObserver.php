<?php

namespace App\Observers;

use App\Models\License;
use Faker\Provider\Uuid;

class LicenseObserver
{
    /**
     * Handle the License "creating" event.
     *
     * @param License $license
     * @return void
     */

    public function creating(License $license): void
    {
        $license->id = Uuid::uuid();
    }
}
