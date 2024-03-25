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
            ->editColumn('user_id', function ($data) {
                return view('dashboard.pages.reseller-dashboard.balance-withdraws.datatable.user', compact('data'));
            })
            ->editColumn('action', function ($data) {
                return view('dashboard.pages.reseller-dashboard.balance-withdraws.datatable.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
