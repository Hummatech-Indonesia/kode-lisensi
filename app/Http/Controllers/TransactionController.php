<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\Products\ProductInterface;
use App\Contracts\Interfaces\TransactionInterface;
use App\Helpers\ResponseHelper;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\HistoryTransactionResource;
use App\Http\Resources\TransactionResource;
use App\Services\TransactionService;
use App\Services\TripayService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TransactionController extends Controller
{
    private ProductInterface $product;
    private TransactionInterface $transaction;
    private TransactionService $service;
    private TripayService $tripayService;

    public function __construct(ProductInterface $product, TransactionService $service, TripayService $tripayService, TransactionInterface $transaction)
    {
        $this->product = $product;
        $this->service = $service;
        $this->tripayService = $tripayService;
        $this->transaction = $transaction;
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $slug
     * @return View
     */

    public function index(string $slug, string $slug_varian = null): View
    {
        $product = $this->product->getWhere(['slug'=>$slug,'slug_varian'=>$slug_varian]);

        return view('pages.checkout', [
            'product' => $product,
            'varian' => $slug_varian,
            'title' => trans('title.checkout', ['product' => $product->name]),
            'payment_channels' => $this->tripayService->handlePaymentChannels()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TransactionRequest $request
     * @param string $slug
     * @return RedirectResponse
     */
    public function store(TransactionRequest $request, string $slug, string $slug_varian = null): RedirectResponse
    {
        $product = $this->product->showWithSlug($slug);

        if (!$this->service->checkProductType($product)) {
            return back()->with('error', trans('alert.empty_stock'));
        }

        $this->service->handleCheckout($request, $product, $slug_varian);

        return back()->with('success', trans('alert.checkout_success'));
    }

    /**
     * apiHistory
     *
     * @return JsonResponse
     */
    public function apiHistory(): JsonResponse
    {
        $transactions = $this->transaction->apiGetHistory();
        return ResponseHelper::success(TransactionResource::collection($transactions));
    }

    /**
     * apiPreorder
     *
     * @return JsonResponse
     */
    public function apiPreorder(): JsonResponse
    {
        $transactions = $this->transaction->apiGetPreorder();
        return ResponseHelper::success(TransactionResource::collection($transactions));
    }
}
