<?php

namespace App\Services;

use App\Enums\InvoiceStatusEnum;
use App\Helpers\CurrencyHelper;
use App\Models\Transaction;
use App\Traits\Datatables\RevenueDatatable;
use Exception;
use Illuminate\Http\Request;

class ExpenditureService
{
    use RevenueDatatable;

    private Transaction $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Handle get today transaction history.
     *
     * @param Request $request
     *
     * @return object
     * @throws Exception
     */

    public function handleGetAll(Request $request): object
    {
        return $this->RevenueMockup($this->transaction->query()
            ->select('id', 'invoice_id', 'created_at', 'invoice_status', 'paid_amount', 'payment_method', 'user_id')
            ->with(['user' => function ($query) {
                return $query->select('id', 'name');
            }, 'detail_transaction.product'])
            ->when($request->date, function ($query) use ($request) {
                $date = explode(' - ', $request->date);
                return $query->whereBetween('created_at', [$date[0] . ' 00:00:00', $date[1] . ' 23:59:59']);
            })
            ->whereIn('invoice_status', [InvoiceStatusEnum::SETTLED->value, InvoiceStatusEnum::PAID->value])
            ->latest()
        );
    }

    /**
     * Handle total amount by date in transaction history.
     *
     * @param Request $request
     *
     * @return string
     */

    public function handleTotalAmount(Request $request): string
    {
        return CurrencyHelper::rupiahCurrency($this->transaction->query()
            ->when($request->date, function ($query) use ($request) {
                $date = explode(' - ', $request->date);
                return $query->whereBetween('created_at', [$date[0] . ' 00:00:00', $date[1] . ' 23:59:59']);
            })
            ->sum('paid_amount')
        );
    }

}
