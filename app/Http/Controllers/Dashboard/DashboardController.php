<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\SummaryService;
use Illuminate\View\View;
use Xendit\Exceptions\ApiException;

class DashboardController extends Controller
{
    private SummaryService $service;

    public function __construct(SummaryService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     * @throws ApiException
     */
    public function index(): View
    {
        return view('dashboard.pages.index', [
            'balance' => $this->service->handleBalance(),
            'order' => $this->service->handleCountOrders(),
            'product' => $this->service->handleCountProducts(),
            'customer' => $this->service->handleCountCustomers(),
            'pieChart' => $this->service->handlePieChart(),
            'lowStockProduct' => $this->service->handleLowStockProducts(),
            'lineChart' => $this->service->handleLineChart(),
            'latestTransaction' => $this->service->handleLatestTransaction(),
            'bestSeller' => $this->service->handleBestSeller()
        ]);
    }
}
