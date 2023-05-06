<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Services\SummaryService;
use Illuminate\View\View;

class HomeController extends Controller
{
    private SummaryService $summaryService;

    public function __construct(SummaryService $summaryService)
    {
        $this->summaryService = $summaryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */

    public function index(): View
    {
        return view('pages.index', [
            'bestSellerProducts' => $this->summaryService->handleBestSeller(8),
            'highestRatingProducts' => $this->summaryService->handleHighestRatings(12),
            'latestProducts' => $this->summaryService->handleLatestProducts()
        ]);
    }

}
