<?php

namespace App\Http\Controllers\Home;

use App\Contracts\Interfaces\ProductFavoriteInterface;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductFavoriteController extends Controller
{
    private ProductFavoriteInterface $productFavorite;

    public function __construct(ProductFavoriteInterface $productFavorite)
    {
        $this->productFavorite = $productFavorite;
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
