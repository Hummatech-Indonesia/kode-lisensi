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
        // $code_affiliate = auth()->user()->code_affiliate;
        // $balance_withdrawals = auth()->user()->balanceWithdrawals;
        // $balance = 0;
        // foreach ($balance_withdrawals as $balance_withdrawal) {
        //     $balance += $balance_withdrawal->balance;
        // }
        // $transactionAffiliates = TransactionAffiliate::query()
        //     ->where('code_affiliate', $code_affiliate)
        //     ->get();
        $saldo = 10000;
        // foreach ($transactionAffiliates as $transactionAffiliate) {
        //     $saldo += $transactionAffiliate->profit;
        // }
        // $saldo -= $balance;
        $data['format'] = "Rp. " . number_format($saldo, 0, ',', '.');
        $data['saldo'] = $saldo;
        return $data;
    }
}
