<?php

namespace App\Observers;

use App\Models\BalanceWithdrawal;
use Faker\Provider\Uuid;

class BalanceWithdrawalObserver
{
    /**
     * Handle the BalanceWithdrawal "created" event.
     *
     * @param  \App\Models\BalanceWithdrawal  $balanceWithdrawal
     * @return void
     */
    public function creating(BalanceWithdrawal $balanceWithdrawal)
    {
        $balanceWithdrawal->id = Uuid::uuid();
    }
}
