<?php

namespace App\Http\Controllers\Home;

use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\Products\ProductInterface;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeCategoryController extends Controller
{
    private ProductInterface $product;
    private CategoryInterface $category;
    private ProductService $productService;
    public function __construct(ProductInterface $product, ProductService $productService, CategoryInterface $category)
    {
        $this->product = $product;
        $this->category = $category;
        $this->productService = $productService;
    }

    /**
     * show
     *
     * @param  mixed $category
     * @return View
     */
    public function show(string $slug, Request $request): View
    {
        $category = $this->category->getWhere(['slug' => $slug]);
        $request->merge(['category_id' => $category->id]);
        $service = $this->productService->handleProductFilters($request);

        if ($request->ajax()) {
            $view = view('pages.cursor.infinite-products')->with('products', $service['products'])->render();

            return ResponseHelper::success([
                'html' => $view,
                'nextCursor' => $service['nextCursor']
            ], trans('alert.fetch_success'));
        }

        return view('pages.category', [
            'title' => 'Kategori ' . $slug . ' - Kodelisensi.com',
            'products' => $service['products'],
            'nextCursor' => $service['nextCursor'],
        ]);
    }
}
