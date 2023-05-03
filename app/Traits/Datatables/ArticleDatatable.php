<?php

namespace App\Traits\Datatables;

use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

trait ArticleDatatable
{

    /**
     * Datatable mockup for customers
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     * @throws Exception
     */

    public function ArticleMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->setFilteredRecords(250)
            ->editColumn('photo', function ($data) {
                return view('dashboard.pages.articles.datatables.photo', compact('data'));
            })
            ->editColumn('status', function ($data) {
                return view('dashboard.pages.articles.datatables.status', compact('data'));
            })
            ->editColumn('action', function ($data) {
                return view('dashboard.pages.articles.datatables.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
