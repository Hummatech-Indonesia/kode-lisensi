<?php

namespace App\Traits\Datatables;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

trait RefundDatatable
{

    /**
     * Datatable mockup for transactions
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     * @throws Exception
     */

    public function RefundMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->setFilteredRecords(250)
            ->editColumn('action', function ($data) {
                return view('dashboard.pages.administrator.refund.datatable.action', compact('data'));
            })
            ->editColumn('proof', function ($data) {
                return view('dashboard.pages.administrator.refund.datatable.proof', compact('data'));
            })
            ->editColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->locale('id_ID')->isoFormat('DD MMMM Y');
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
