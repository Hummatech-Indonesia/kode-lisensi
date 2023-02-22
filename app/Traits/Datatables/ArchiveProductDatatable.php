<?php

namespace App\Traits\Datatables;

use App\Helpers\CurrencyHelper;
use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

trait ArchiveProductDatatable
{

    /**
     * Datatable mockup for customers
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     * @throws Exception
     */

    public function ArchiveProductMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->setFilteredRecords(250)
            ->editColumn('photo', function ($data) {
                return view('dashboard.pages.products.datatables.photo', compact('data'));
            })
            ->editColumn('stock', function ($data) {
                return view('dashboard.pages.products.datatables.stock', compact('data'));
            })
            ->editColumn('buy_price', function ($data) {
                return CurrencyHelper::rupiahCurrency($data->buy_price);
            })
            ->editColumn('sell_price', function ($data) {
                return CurrencyHelper::rupiahCurrency($data->sell_price);
            })
            ->editColumn('action', function ($data) {
                return view('dashboard.pages.products.datatables.archive-action', compact('data'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
