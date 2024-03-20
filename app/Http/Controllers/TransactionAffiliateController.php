<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\Products\ProductInterface;
use App\Contracts\Interfaces\TransactionAffiliateInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Http\Requests\TransactionRequest;
use App\Services\TransactionAffiliateService;
use App\Services\TransactionService;
use App\Services\TripayService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TransactionAffiliateController extends Controller
{
    private ProductInterface $product;
    private TripayService $tripayService;
    private UserInterface $user;
    private TransactionService $service;
    private TransactionAffiliateService $transactionAffiliateService;

    public function __construct(ProductInterface $product, TripayService $tripayService, TransactionService $service,  UserInterface $user, TransactionAffiliateService $transactionAffiliateService)
    {
        $this->product = $product;
        $this->user = $user;
        $this->transactionAffiliateService = $transactionAffiliateService;
        $this->service = $service;
        $this->tripayService = $tripayService;
    }

    /**
     * index
     *
     * @param  mixed $slug
     * @param  mixed $code_affiliate
     * @param  mixed $slug_varian
     * @return View
     */
    public function index(string $slug, string $code_affiliate, string $slug_varian = null): View
    {
        $product = $this->product->getWhere(['slug' => $slug, 'slug_varian' => $slug_varian]);

        return view('pages.checkout-product', [
            'product' => $product,
            'code_affiliate' => $code_affiliate,
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
    public function store(TransactionRequest $request, string $slug, string $code_affiliate, string $slug_varian = null): RedirectResponse
    {
        $product = $this->product->showWithSlug($slug);


        if (!$this->service->checkProductType($product)) {
            return back()->with('error', trans('alert.empty_stock'));
        }

        $this->service->handleCheckoutAffiliate($request, $product, $slug_varian, $code_affiliate);


        return back()->with('success', trans('alert.checkout_success'));
    }
}
