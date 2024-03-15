<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\Products\ProductRecommendationInterface;
use App\Helpers\ResponseHelper;
use App\Http\Requests\ProductRecommendationRequest;
use App\Models\Product;
use App\Models\ProductRecommendation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductRecommendationController extends Controller
{
    private ProductRecommendationInterface $productRecommendation;

    public function __construct(ProductRecommendationInterface $productRecommendation)
    {
        $this->productRecommendation = $productRecommendation;
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
