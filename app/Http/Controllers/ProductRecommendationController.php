<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\Products\ProductInterface;
use App\Contracts\Interfaces\Products\ProductRecommendationInterface;
use App\Helpers\ResponseHelper;
use App\Http\Requests\ProductRecommendationRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductRecommendationController extends Controller
{
    private ProductRecommendationInterface $productRecommendation;
    private ProductInterface $product;

    public function __construct(ProductRecommendationInterface $productRecommendation, ProductInterface $product)
    {
        $this->productRecommendation = $productRecommendation;
        $this->product = $product;
    }

    /**
     * get
     *
     * @return object
     */
    public function get(Request $request): object
    {
        if ($request->ajax()) return $this->product->getProductRecommendation();

        return view('dashboard.pages.recommendation-products.index');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function store(ProductRecommendationRequest $request, Product $product): JsonResponse
    {
        $data = $request->validated();
        $data['product_id'] = $product->id;
        $this->productRecommendation->store($data);
        return ResponseHelper::success(null, trans('alert.add_success'));
    }
}
