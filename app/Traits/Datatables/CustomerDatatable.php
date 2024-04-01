<?php

namespace App\Traits\Datatables;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

trait CustomerDatatable
{

    /**
     * Datatable mockup for customers
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     * @throws Exception
     */

    public function CustomerMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->setFilteredRecords(250)
            ->editColumn('photo', function ($data) {
                return view('dashboard.pages.customers.datatables.photo', compact('data'));
            })
            ->editColumn('phone_number', function ($data) {
                return $data->phone_number ?? 'Nomor belum terdaftar';
            })
            ->editColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->translatedFormat('d F Y');
            })
            ->editColumn('action', function ($data) {
                return view('dashboard.pages.customers.datatables.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
