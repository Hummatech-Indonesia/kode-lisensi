<?php

namespace App\Http\Controllers\Dashboard\Products;

use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\Products\ProductInterface;
use App\Enums\ProductStatusEnum;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\ProductStoreRequest;
use App\Http\Requests\Dashboard\Product\ProductUpdateRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    private ProductService $productService;
    private ProductInterface $product;
    private CategoryInterface $category;

    public function __construct(ProductService $productService, ProductInterface $product, CategoryInterface $category)
    {
        $this->productService = $productService;
        $this->product = $product;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return object
     */

    public function index(Request $request): object
    {
        if ($request->ajax()) return $this->product->get();

        return view('dashboard.pages.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $categories = $this->category->get();
        return view('dashboard.pages.products.add', compact('categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return View
     */
    public function show(Product $product): View
    {
        return view('dashboard.pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return View
     */
    public function edit(Product $product): View
    {
        $categories = $this->category->get();
        return view('dashboard.pages.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductUpdateRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(ProductUpdateRequest $request, Product $product): RedirectResponse
    {
        if (!$data = $this->productService->update($product, $request)) {
            return back()->with('error', trans('alert.file_exist'));
        }

        $this->product->update($product->id, $data);

        return to_route('products.show', $product->id)->with('success', trans('alert.update_success'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ProductStoreRequest $request): RedirectResponse
    {
        if (!$data = $this->productService->store($request)) {
            return back()->with('error', trans('alert.file_exist'));
        }

        $product = $this->product->store($data);

        if ($product->status == ProductStatusEnum::PREORDER->value) {
            return to_route('preorder-products.index')->with('success', trans('alert.add_success'));
        }

        return to_route('products.index')->with('success', trans('alert.add_success'));
    }


    /**
     * Get stock license detail using ajax
     *
     * @param Product $product
     * @return JsonResponse
     */

    public function getStockDetail(Product $product): JsonResponse
    {
        $data = $this->productService->countStocks($product);

        return ResponseHelper::success($data, trans('alert.delete_success'));
    }
}
