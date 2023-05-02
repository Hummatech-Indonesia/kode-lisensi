<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\RevenueService;
use Exception;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    private RevenueService $service;

    public function __construct(RevenueService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return object
     *
     * @throws Exception
     */

    public function index(Request $request): object
    {
        if ($request->ajax()) return $this->service->handleGetAll($request);

        return view('dashboard.pages.revenues.index');
    }

    /**
     * Handle total amount from transaction.
     *
     * @param Request $request
     *
     * @return string
     */

    public function totalAmount(Request $request): string
    {
        if ($request->ajax()) return $this->service->handleTotalAmount($request);
    }
}
