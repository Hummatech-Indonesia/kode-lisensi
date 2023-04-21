<?php

namespace App\Http\Controllers\Dashboard\Products;

use App\Contracts\Interfaces\Products\ProductQuestionInterface;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\ProductQuestionRequest;
use App\Models\ProductQuestion;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ErrorResponse;

class ProductQuestionController extends Controller
{
    private ProductQuestionInterface $product;

    public function __construct(ProductQuestionInterface $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */

    public function index(Request $request): JsonResponse
    {
        if ($request->ajax()) return $this->product->get();

        abort(ErrorResponse::HTTP_FORBIDDEN);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductQuestionRequest $request
     * @return JsonResponse
     */
    public function store(ProductQuestionRequest $request): JsonResponse
    {
        $this->product->store($request->validated());

        return ResponseHelper::success(null, trans('alert.add_success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductQuestionRequest $request
     * @param ProductQuestion $product_question
     * @return JsonResponse
     */
    public function update(ProductQuestionRequest $request, ProductQuestion $product_question): JsonResponse
    {
        $this->product->update($product_question->id, $request->validated());

        return ResponseHelper::success(null, trans('alert.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductQuestion $product_question
     * @return JsonResponse
     */

    public function destroy(ProductQuestion $product_question): JsonResponse
    {
        $this->product->delete($product_question->id);

        return ResponseHelper::success(null, trans('alert.delete_success'));
    }
}
