<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\SummaryService;
use Illuminate\Http\JsonResponse;
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

    /**
     * apiDashboard
     *
     * @return JsonResponse
     */
    public function apiDashboard(): JsonResponse
    {
        dd(auth()->user()->id);
        $balance = $this->service->handleBalance();
        $balance = strval($balance);
        $order = $this->service->handleCountOrders();
        $order = strval($order);
        $product = $this->service->handleCountProducts();
        $product = strval($product);
        $customer = $this->service->handleCountCustomers();
        $customer = strval($customer);
        $pieChart = $this->service->handlePieChart();
        $lowStockProduct = $this->service->handleLowStockProducts();
        $lineChart = $this->service->handleLineChart();
        $latestTransaction = $this->service->handleLatestTransaction();
        $bestSeller = $this->service->handleBestSeller();
        return ResponseHelper::success(['balance' => $balance, 'order' => $order, 'product' => $product, 'customer' => $customer, 'pieChart' => $pieChart, 'lowStockProduct' => $lowStockProduct, 'lineChart' => $lineChart, 'latestTransaction' => $latestTransaction, 'bestSeller' => $bestSeller]);
    }
}
