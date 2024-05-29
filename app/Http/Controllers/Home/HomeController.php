<?php

namespace App\Http\Controllers\Home;

use App\Contracts\Interfaces\BannerInterface;
use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\ProductFavoriteInterface;
use App\Contracts\Interfaces\SliderInterface;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\SummaryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    private SummaryService $summaryService;
    private SliderInterface $slider;
    private BannerInterface $banner;
    private ProductFavoriteInterface $productFavorite;
    private CategoryInterface $category;

    public function __construct(SummaryService $summaryService, SliderInterface $slider, BannerInterface $banner, ProductFavoriteInterface $productFavorite, CategoryInterface $category)
    {
        $this->summaryService = $summaryService;
        $this->slider = $slider;
        $this->banner = $banner;
        $this->productFavorite = $productFavorite;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */

    public function index(Request $request): View
    {
        // dd($this->summaryService->handleLatestProducts());
        return view('pages.index', [
            'productRecommendation' => $this->summaryService->productRecommendations(),
            'latestProductNotRecommendations' => $this->summaryService->handleLatestProductNotReccomendation(),
            'latestProductNotBestSellers' => $this->summaryService->handleLatestProductNotBestSeller(),
            'latestProductNotRatings' => $this->summaryService->handleLatestProductNotRating(),
            'latestProducts' => $this->summaryService->handleLatestProducts(),
            'bestSellerProducts' => $this->summaryService->handleBestSeller(8),
            'bestSellerProductPage' => $this->summaryService->handleBestSellerPage(8),
            'highestRatingProducts' => $this->summaryService->handleHighestRatings(12),
            'sliders' => $this->slider->get(),
            'banners' => $this->banner->get(),
            'categories' => $this->category->get()
        ]);
    }

    /**
     * latestProduct
     *
     * @return JsonResponse
     */
    public function latestProduct(): JsonResponse
    {
        $latestProducts = $this->summaryService->handleLatestProducts();
        return ResponseHelper::success($latestProducts);
    }
}
