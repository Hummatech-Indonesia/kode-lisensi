<?php

namespace App\Traits\Datatables;

use App\Helpers\CurrencyHelper;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

trait ResellerDatatable
{

    /**
     * Datatable mockup for customers
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     * @throws Exception
     */

    public function ResellerMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->setFilteredRecords(250)
            ->editColumn('photo', function ($data) {
                return view('dashboard.pages.resellers.datatables.photo', compact('data'));
            })
            ->editColumn('phone_number', function ($data) {
                return $data->phone_number ?? 'Nomor belum terdaftar';
            })
            ->addColumn('transactions.total', function ($data) {
                return ($data->transactions_count > 0) ? $data->transactions_count . " item" : 'Belum ada item';
            })
            ->addColumn('transactions.paid_amount', function ($data) {
                return ($data->transactions_sum_paid_amount) ? CurrencyHelper::rupiahCurrency($data->transactions_sum_paid_amount) : 'Belum ada pembelian';
            })
            ->editColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->translatedFormat('d F Y');
            })
            ->rawColumns(['transactions.total', 'transactions.paid_amount'])
            ->toJson();
    }
}
