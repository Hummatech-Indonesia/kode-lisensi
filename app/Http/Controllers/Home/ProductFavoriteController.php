<?php

namespace App\Http\Controllers\Home;

use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\ProductFavoriteInterface;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductFavoriteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductFavoriteController extends Controller
{
    private ProductFavoriteInterface $productFavorite;
    private ProductFavoriteService $productFavoriteService;
    private CategoryInterface $category;

    public function __construct(ProductFavoriteInterface $productFavorite, ProductFavoriteService $productFavoriteService, CategoryInterface $category)
    {
        $this->productFavorite = $productFavorite;
        $this->productFavoriteService = $productFavoriteService;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $service = $this->productFavoriteService->handleProductFilters($request);


        if ($request->ajax()) {
            $view = view('pages.favorite-products.infinite-products')->with('products', $service['products'])->render();

            return ResponseHelper::success([
                'html' => $view,
                'nextCursor' => $service['nextCursor']
            ], trans('alert.fetch_success'));
        }

        return view('pages.favorite-product', [
            'title' => trans('title.product'),
            'products' => $service['products'],
            'nextCursor' => $service['nextCursor'],
            'categories' => $this->category->get()
        ]);
    }

    /**
     * show
     *
     * @param  mixed $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        $product = $this->productFavorite->getWhere([
            'user_id' => auth()->user()->id,
            'product_id' => $product->id
        ]);

        return ResponseHelper::success($product);
    }
    /**
     * store
     *
     * @return void
     */
    public function store(Product $product): JsonResponse
    {
        $this->productFavorite->store([
            'user_id' => auth()->user()->id,
            'product_id' => $product->id
        ]);
        return ResponseHelper::success(null, trans('alert.add_success'));
    }

    /**
     * delete
     *
     * @param  mixed $product
     * @return JsonResponse
     */
    public function delete(Product $product): JsonResponse
    {
        $product = $this->productFavorite->getWhere([
            'user_id' => auth()->user()->id,
            'product_id' => $product->id
        ]);
        $this->productFavorite->delete($product->id);
        return ResponseHelper::success(null, trans('alert.delete_success'));
    }
}
