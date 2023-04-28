<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\Products\ProductInterface;
use App\Http\Requests\TransactionRequest;
use App\Services\TransactionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TransactionController extends Controller
{
    private ProductInterface $product;
    private TransactionService $service;

    public function __construct(ProductInterface $product, TransactionService $service)
    {
        $this->product = $product;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $slug
     * @return View
     */

    public function index(string $slug): View
    {
        $product = $this->product->showWithSlug($slug);

        return view('pages.checkout', [
            'product' => $product,
            'title' => trans('title.checkout', ['product' => $product->name])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TransactionRequest $request
     * @param string $slug
     * @return RedirectResponse
     */
    public function store(TransactionRequest $request, string $slug): RedirectResponse
    {
        $product = $this->product->showWithSlug($slug);

        if (!$this->service->checkProductType($product)) {
            return back()->with('error', trans('alert.empty_stock'));
        }

        $this->service->handleCheckout($request, $product);

        return back()->with('success', trans('alert.checkout_success'));
    }
}
