<?php

namespace App\Http\Controllers\Home;

use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\Products\ProductInterface;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class HomeProductController extends Controller
{
    private ProductInterface $product;
    private CategoryInterface $category;
    private ProductService $productService;

    public function __construct(ProductInterface $product, CategoryInterface $category, ProductService $productService)
    {
        $this->product = $product;
        $this->category = $category;
        $this->productService = $productService;
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
     * @param int $id
     * @return Response
     */
    public function show(string $slug)
    {
        dd($slug);
    }
}
