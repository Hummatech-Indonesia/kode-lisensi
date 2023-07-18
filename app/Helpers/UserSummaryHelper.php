<?php

namespace App\Helpers;

use App\Enums\InvoiceStatusEnum;
use App\Enums\RatingStatusEnum;
use App\Models\Transaction;

class UserSummaryHelper
{
    /**
     * Handle sum amount order
     *
     * @return int
     */

    public static function sumAmountOrder(): int
    {
        return Transaction::query()
            ->whereHas('detail_transaction.product')
            ->where('user_id', auth()->id())
            ->whereIn('invoice_status', [InvoiceStatusEnum::SETTLED->value, InvoiceStatusEnum::PAID->value])
            ->sum('paid_amount');
    }

    /**
     * Handle count complete or pending order
     *
     * @param string $condition
     * @return int
     */

    public static function countUserOrders(string $condition): int
    {
        return Transaction::query()
            ->whereHas('detail_transaction.product')
            ->where('user_id', auth()->id())
            ->when($condition == 'success', function ($query) {
                return $query->whereIn('invoice_status', [InvoiceStatusEnum::SETTLED->value, InvoiceStatusEnum::PAID->value]);
            })
            ->when($condition == 'pending', function ($query) {
                return $query->where('invoice_status', InvoiceStatusEnum::PENDING->value);
            })
            ->count();
    }

    /**
     * Handle get latest user transaction
     *
     * @return object
     */

    public static function latestUserTransaction(): object
    {
        return Transaction::query()
            ->whereHas('detail_transaction.product')
            ->where('user_id', auth()->id())
            ->with('detail_transaction.product', function ($query) {
                return $query->withCount('product_ratings')
                    ->withSum(['product_ratings' => function ($query) {
                        $query->where('status', RatingStatusEnum::APPROVED->value);
                    }], 'rating');
            })
            ->take(10)
            ->latest()
            ->get();

    }
}
