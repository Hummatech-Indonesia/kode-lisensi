<?php

namespace App\Traits\Datatables;

use App\Helpers\CurrencyHelper;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

trait SliderDatatable
{

    /**
     * Datatable mockup for transactions
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     * @throws Exception
     */

    public function SliderMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->setFilteredRecords(250)
            ->editColumn('image', function ($data) {
                return view('dashboard.pages.sliders.datatables.image', compact('data'));
            })
            ->editColumn('action', function ($data) {
                return view('dashboard.pages.sliders.datatables.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
