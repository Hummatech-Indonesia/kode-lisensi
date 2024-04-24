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
            ->editColumn('paid_amount', function ($data) {
                return CurrencyHelper::rupiahCurrency($data->paid_amount);
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
                return view('dashboard.pages.orders.datatables.action', compact('data'));
            })
            ->editColumn('created_at', function ($data) {
                return view('dashboard.pages.orders.datatables.created_at', compact('data'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
