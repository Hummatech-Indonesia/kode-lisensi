<?php

namespace App\Http\Controllers\Home;

use App\Contracts\Interfaces\BannerInterface;
use App\Contracts\Interfaces\ProductFavoriteInterface;
use App\Contracts\Interfaces\SliderInterface;
use App\Http\Controllers\Controller;
use App\Services\SummaryService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    private SummaryService $summaryService;
    private SliderInterface $slider;
    private BannerInterface $banner;
    private ProductFavoriteInterface $productFavorite;

    public function __construct(SummaryService $summaryService, SliderInterface $slider, BannerInterface $banner, ProductFavoriteInterface $productFavorite)
    {
        $this->summaryService = $summaryService;
        $this->slider = $slider;
        $this->banner = $banner;
        $this->productFavorite = $productFavorite;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */

    public function index(Request $request): View
    {
        return view('pages.index', [
            'bestSellerProducts' => $this->summaryService->handleBestSeller(8),
            'highestRatingProducts' => $this->summaryService->handleHighestRatings(12),
            'latestProducts' => $this->summaryService->handleLatestProducts(),
            'slider' => $this->slider->get(),
            'banners' => $this->banner->get()
        ]);
    }
}
