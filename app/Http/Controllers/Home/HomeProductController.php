<?php

namespace App\Http\Controllers\Home;

use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\Products\ProductInterface;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Services\SummaryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeProductController extends Controller
{
    private ProductInterface $product;
    private CategoryInterface $category;
    private ProductService $productService;
    private SummaryService $summaryService;

    public function __construct(ProductInterface $product, CategoryInterface $category, ProductService $productService, SummaryService $summaryService)
    {
        $this->product = $product;
        $this->category = $category;
        $this->productService = $productService;
        $this->summaryService = $summaryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        $service = $this->productService->handleProductFilters($request);

        if ($request->ajax()) {
            $view = view('pages.cursor.infinite-products')->with('products', $service['products'])->render();

            return ResponseHelper::success([
                'html' => $view,
                'nextCursor' => $service['nextCursor']
            ], trans('alert.fetch_success'));
        }

        return view('pages.product', [
            'title' => trans('title.product'),
            'products' => $service['products'],
            'nextCursor' => $service['nextCursor'],
            'categories' => $this->category->get()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return View
     */

    public function show(string $slug): View
    {
        $product = $this->product->showWithSlug($slug);

        return view('pages.product-detail', [
            'title' => trans('title.product_detail', ['product' => $product->name]),
            'product' => $product,
            'recommendProducts' => $this->summaryService->handleRecommendProducts(),
            'sameCategoryProducts' => $this->summaryService->handleSameCategoryProducts($product->id, $product->category_id)
        ]);
    }
}
