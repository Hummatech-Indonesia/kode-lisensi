<?php

namespace App\Traits\Datatables;

use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

trait ProductDatatable
{

    /**
     * Datatable mockup for customers
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     * @throws Exception
     */

    public function ProductMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->setFilteredRecords(250)
            ->editColumn('photo', function ($data) {
                return view('dashboard.pages.products.datatables.photo', compact('data'));
            })
            ->editColumn('action', function ($data) {

            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
