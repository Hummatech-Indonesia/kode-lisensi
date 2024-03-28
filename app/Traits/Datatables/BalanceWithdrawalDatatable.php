<?php

namespace App\Traits\Datatables;

use App\Helpers\CurrencyHelper;
use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

trait BalanceWithdrawalDatatable
{

    /**
     * Datatable mockup for customers
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     * @throws Exception
     */

    public function BalanceWithdrawalMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->setFilteredRecords(250)
            ->editColumn('balance', function ($data) {
                return view('dashboard.pages.reseller-dashboard.balance-withdraws.datatable.balance', compact('data'));
            })
            ->editColumn('created_at', function ($data) {
                return view('dashboard.pages.reseller-dashboard.balance-withdraws.datatable.created-at', compact('data'));
            })
            ->editColumn('status', function ($data) {
                return view('dashboard.pages.reseller-dashboard.balance-withdraws.datatable.status', compact('data'));
            })
            ->editColumn('rekening_number_id', function ($data) {
                return $data->rekening_number->rekening;
            })
            ->editColumn('action', function ($data) {
                return view('dashboard.pages.reseller-dashboard.balance-withdraws.datatable.action', compact('data'));
            })
            ->editColumn('detail', function ($data) {
                return view('dashboard.pages.reseller-dashboard.balance-withdraws.datatable.detail', compact('data'));
            })
            ->rawColumns(['action', 'detail'])
            ->toJson();
    }
}
