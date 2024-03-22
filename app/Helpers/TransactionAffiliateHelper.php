<?php

namespace App\Helpers;

use App\Models\TransactionAffiliate;

class TransactionAffiliateHelper
{

    /**
     * static
     *
     * @return mixed
     */
    public static function profit(): mixed
    {
        $code_affiliate = auth()->user()->code_affiliate;
        $transactionAffiliates = TransactionAffiliate::query()
            ->where('code_affiliate', $code_affiliate)
            ->get();
        $saldo = 0;
        foreach ($transactionAffiliates as $transactionAffiliate) {
            $saldo += $transactionAffiliate->profit;
        }
        $data['format'] = "Rp. " . number_format($saldo, 0, ',', '.');
        $data['saldo'] = $saldo;
        return $data;
    }
}
