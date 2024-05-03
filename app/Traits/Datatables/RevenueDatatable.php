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
                $amount = $data->amount;
                return CurrencyHelper::rupiahCurrency($amount - $buyPrice);
            })
            ->editColumn('order_via_whatsapp', function ($data) {
                return view('dashboard.pages.orders.datatables.via', compact('data'));
            })
            ->editColumn('created_at', function ($data) {
                return view('dashboard.pages.orders.datatables.created_at', compact('data'));
            })
            ->editColumn('amount', function ($data) {
                return CurrencyHelper::rupiahCurrency($data->amount);
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
