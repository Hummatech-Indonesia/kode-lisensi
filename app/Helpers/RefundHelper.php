<?php

namespace App\Helpers;

use App\Models\Transaction;

class RefundHelper
{
    /**
     * getMyTransaction
     *
     * @return mixed
     */
    public static function getMyTransaction(): mixed
    {
        return Transaction::query()
            ->where('user_id', auth()->id())
            ->WhereNotNull('paid_amount')
            ->get();
    }
}
