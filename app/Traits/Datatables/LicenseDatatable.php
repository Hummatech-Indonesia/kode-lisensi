<?php

namespace App\Traits\Datatables;

use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

trait LicenseDatatable
{
    /**
     * Datatable mockup for customers
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     * @throws Exception|Exception
     */

    public function LicenseMockup(mixed $collection): JsonResponse
    {

        return DataTables::of($collection)
            ->addIndexColumn()
            ->setRowId('id')
            ->setFilteredRecords(250)
            ->editColumn('username', function ($data) {
                return view('dashboard.pages.licenses.datatables.username', compact('data'));
            })
            ->editColumn('password', function ($data) {
                return view('dashboard.pages.licenses.datatables.password', compact('data'));
            })
            ->editColumn('serial_key', function ($data) {
                return view('dashboard.pages.licenses.datatables.serial_key', compact('data'));
            })
            ->editColumn('is_purchased', function ($data) {
                return view('dashboard.pages.licenses.datatables.is_purchased', compact('data'));

            })
            ->editColumn('action', function ($data) {
                return view('dashboard.pages.licenses.datatables.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
