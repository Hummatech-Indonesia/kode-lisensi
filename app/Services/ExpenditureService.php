<?php

namespace App\Services;

use App\Enums\InvoiceStatusEnum;
use App\Helpers\CurrencyHelper;
use App\Models\Expenditure;
use App\Traits\Datatables\ExpenditureDatatable;
use Exception;
use Illuminate\Http\Request;

class ExpenditureService
{
    use ExpenditureDatatable;

    private Expenditure $expenditure;

    public function __construct(Expenditure $expenditure)
    {
        $this->expenditure = $expenditure;
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
        return $this->ExpenditureMockup($this->expenditure->query()
            ->select('id', 'used_for','balance_used','balance_withdrawn','description')
            
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
