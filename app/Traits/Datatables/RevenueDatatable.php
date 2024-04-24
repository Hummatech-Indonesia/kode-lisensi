<?php

namespace App\Traits\Datatables;

use App\Helpers\CurrencyHelper;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

trait RevenueDatatable
{
    /**
     * Datatable mockup for Revenue
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     * @throws Exception
     */

    public function RevenueMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->addColumn('revenue', function ($data) {
                if ($data->detail_transaction->varianProduct) {
                    $buyPrice = $data->detail_transaction->varianProduct->buy_price;
                } else {
                    $buyPrice = $data->detail_transaction->product->buy_price;
                }
                $amount = $data->paid_amount;
                return CurrencyHelper::rupiahCurrency($amount - $buyPrice);
            })
            ->editColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->format('d M Y h:i');
            })
            ->editColumn('paid_amount', function ($data) {
                return CurrencyHelper::rupiahCurrency($data->paid_amount);
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
