<?php

namespace App\Http\Controllers\Home;

use App\Contracts\Interfaces\SliderInterface;
use App\Http\Controllers\Controller;
use App\Services\SummaryService;
use Illuminate\View\View;

class HomeController extends Controller
{
    private SummaryService $summaryService;
    private SliderInterface $slider;

    public function __construct(SummaryService $summaryService, SliderInterface $slider)
    {
        $this->summaryService = $summaryService;
        $this->slider = $slider;
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
            'latestProducts' => $this->summaryService->handleLatestProducts(),
            'slider' => $this->slider->get()
        ]);
    }

}
