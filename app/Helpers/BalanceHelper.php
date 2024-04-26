<?php

namespace App\Helpers;

use App\Enums\BalanceUsedEnum;
use App\Enums\InvoiceStatusEnum;
use App\Models\Expenditure;
use App\Models\Transaction;

class BalanceHelper
{
    /**
     * overallBalance
     *
     * @return void
     */
    public static function overallExpenditure(): int
    {
        return Expenditure::query()
            ->sum('balance_withdrawn');
    }

    /**
     * tripayExpenditure
     *
     * @return int
     */
    public static function tripayExpenditure(): int
    {
        return Expenditure::query()
            ->where('balance_used', BalanceUsedEnum::TRIPAY->value)
            ->sum('balance_withdrawn');
    }

    /**
     * rekeningExpenditure
     *
     * @return int
     */
    public static function rekeningExpenditure(): int
    {
        return Expenditure::query()
            ->where('balance_used', BalanceUsedEnum::REKENING->value)
            ->sum('balance_withdrawn');
    }

    /**
     * handleBalance
     *
     * @return int
     */
    public static function handleBalance(): int
    {
        $handleBalance = Transaction::query()
            ->where('invoice_status', InvoiceStatusEnum::PAID->value)
            ->sum('amount');
        $overallExpenditure = BalanceHelper::overallExpenditure();
        return $handleBalance - $overallExpenditure;
    }

    /**
     * handleWhatsappBalance
     *
     * @return int
     */
    public static function handleWhatsappBalance(): int
    {
        $whatsappBalance = Transaction::query()
            ->where('order_via_whatsapp', 1)
            ->where('invoice_status', InvoiceStatusEnum::PAID->value)
            ->sum('amount');
        $rekeningExpenditure = BalanceHelper::rekeningExpenditure();
        return $whatsappBalance - $rekeningExpenditure;
    }

    /**
     * handleTripayBalance
     *
     * @return int
     */
    public static function handleTripayBalance(): int
    {
        $tripayBalance = Transaction::query()
            ->where('order_via_whatsapp', 0)
            ->where('invoice_status', InvoiceStatusEnum::PAID->value)
            ->sum('amount');
        $tripayExpenditure = BalanceHelper::tripayExpenditure();
        return $tripayBalance - $tripayExpenditure;
    }

    /**
     * handleRevenue
     *
     * @return int
     */
    public static function handleRevenue(): int
    {
        $transactions = Transaction::query()->where('invoice_status', InvoiceStatusEnum::PAID->value)->get();

        $revenue = 0;

        foreach ($transactions as $transaction) {
            if ($transaction->detail_transaction->varianProduct) {
                $buyPrice = $transaction->detail_transaction->varianProduct->buy_price;
            } else {
                $buyPrice = $transaction->detail_transaction->product?->buy_price;
            }

            $amount = $transaction->amount;

            $revenue += ($amount - $buyPrice);
        }
        return $revenue;
    }

    /**
     * handleTripayRevenue
     *
     * @return int
     */
    public static function handleTripayRevenue(): int
    {
        $transactions = Transaction::query()->where('order_via_whatsapp', 0)->where('invoice_status', InvoiceStatusEnum::PAID->value)->get();

        $revenue = 0;

        foreach ($transactions as $transaction) {
            if ($transaction->detail_transaction->varianProduct) {
                $buyPrice = $transaction->detail_transaction->varianProduct->buy_price;
            } else {
                $buyPrice = $transaction->detail_transaction->product?->buy_price;
            }

            $amount = $transaction->amount;

            $revenue += ($amount - $buyPrice);
        }
        return $revenue;
    }

    /**
     * handleWhatsappRevenue
     *
     * @return int
     */
    public static function handleWhatsappRevenue(): int
    {
        $transactions = Transaction::query()
            ->where('invoice_status', InvoiceStatusEnum::PAID->value)
            ->where('order_via_whatsapp', 1)
            ->get();

        $revenue = 0;

        foreach ($transactions as $transaction) {
            if ($transaction->detail_transaction->varianProduct) {
                $buyPrice = $transaction->detail_transaction->varianProduct->buy_price;
            } else {
                $buyPrice = $transaction->detail_transaction->product?->buy_price;
            }

            $amount = $transaction->amount;

            $revenue += ($amount - $buyPrice);
        }

        return $revenue;
    }
}
