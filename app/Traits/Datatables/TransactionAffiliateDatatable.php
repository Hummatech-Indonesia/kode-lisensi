<?php

namespace App\Traits\Datatables;

use App\Helpers\CurrencyHelper;
use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

trait TransactionAffiliateDatatable
{

    /**
     * Datatable mockup for transactions
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     * @throws Exception
     */

    public function TransactionAffiliateMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->setFilteredRecords(250)
            ->editColumn('product', function ($data) {
                return view('dashboard.pages.orders.datatables.product', compact('data'));
            })
            ->editColumn('customer', function ($data) {
                return view('dashboard.pages.orders.datatables.customer', compact('data'));
            })
            ->editColumn('profit', function ($data) {
                return view('dashboard.pages.orders.datatables.profit', compact('data'));
            })
            ->rawColumns(['action', 'product'])
            ->toJson();
    }
}
