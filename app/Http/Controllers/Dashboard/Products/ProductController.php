<?php

namespace App\Http\Controllers\Dashboard\Products;

use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\Products\ProductInterface;
use App\Enums\ProductStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\ProductStoreRequest;
use App\Models\Product;
use App\Services\ProductService;
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
        return view('dashboard.pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        return to_route('')->with('success', trans('alert.update_success'));
    }
}
