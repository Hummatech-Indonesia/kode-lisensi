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
        $balance = 0;
        $rekening_numbers = auth()->user()->rekeningNumbers;
        foreach ($rekening_numbers as $rekening_number) {
            $balanceWithdrawals = $rekening_number->balanceWithdrawals;
            foreach ($balanceWithdrawals as $balanceWithdrawal) {
                $balance += $balanceWithdrawal->balance;
            }
        }
        $transactionAffiliates = TransactionAffiliate::query()
            ->where('code_affiliate', $code_affiliate)
            ->get();
        $saldo = 0;
        foreach ($transactionAffiliates as $transactionAffiliate) {
            $saldo += $transactionAffiliate->profit;
        }
        $saldo -= $balance;
        $data['format'] = "Rp. " . number_format($saldo, 0, ',', '.');
        $data['saldo'] = $saldo;
        return $data;
    }
}
