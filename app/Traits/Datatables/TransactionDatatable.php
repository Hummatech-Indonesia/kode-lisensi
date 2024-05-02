<?php

namespace App\Traits\Datatables;

use App\Helpers\CurrencyHelper;
use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

trait TransactionDatatable
{

    /**
     * Datatable mockup for transactions
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     * @throws Exception
     */

    public function TransactionMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->setFilteredRecords(250)
            ->addColumn('revenue', function ($data) {
                if ($data->detail_transaction->varianProduct) {
                    $buyPrice = $data->detail_transaction->varianProduct->buy_price;
                } else {
                    $buyPrice = $data->detail_transaction->product->buy_price;
                }
                $amount = $data->amount;
                return CurrencyHelper::rupiahCurrency($amount - $buyPrice);
            })
            ->editColumn('amount', function ($data) {
                return CurrencyHelper::rupiahCurrency($data->amount);
            })
            ->editColumn('action', function ($data) {
                return view('dashboard.pages.orders.datatables.action', compact('data'));
            })
            ->editColumn('created_at', function ($data) {
                return view('dashboard.pages.orders.datatables.created_at', compact('data'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }
    /**
     * Method TransactionMockup
     *
     * @param mixed $collection [explicite description]
     *
     * @return JsonResponse
     */
    public function PendingTransactionMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->setFilteredRecords(250)

            ->editColumn('action', function ($data) {
                return view('dashboard.pages.orders.datatables.pending-action', compact('data'));
            })
            ->editColumn('created_at', function ($data) {
                return view('dashboard.pages.orders.datatables.created_at', compact('data'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
