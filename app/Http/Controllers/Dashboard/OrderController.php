<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\Products\ProductInterface;
use App\Contracts\Interfaces\TransactionInterface;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

// use Illuminate\View\View;

class OrderController extends Controller
{
    private TransactionInterface $transaction;
    private TransactionService $service;
    private ProductInterface $product;

    public function __construct(TransactionInterface $transaction, TransactionService $service, ProductInterface $product)
    {
        $this->transaction = $transaction;
        $this->service = $service;
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        $products = $this->product->getProduct();
        if ($request->ajax())
            return $this->transaction->get();
        return view('dashboard.pages.orders.index', ['products', $products]);
    }

    /**
     * Display the specified resource.
     *
     * @param string $invoice_id
     * @return View
     */
    public function show(string $invoice_id): View
    {
        $transaction = $this->transaction->show($invoice_id);

        return view('dashboard.pages.orders.detail', compact('transaction'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View|JsonResponse
     */
    public function fetchHistories(Request $request): View|JsonResponse
    {
        if ($request->ajax())
            return $this->transaction->search($request);

        return view('dashboard.pages.orders.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View|JsonResponse
     */
    public function fetchPendingHistories(Request $request): View|JsonResponse
    {
        if ($request->ajax())
            return $this->transaction->getPending();

        return view('dashboard.pages.orders.pending');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $invoice_id
     * @return RedirectResponse
     */
    public function update(Request $request, string $invoice_id): RedirectResponse
    {
        $this->service->handleSendLicense($request, $invoice_id);

        return to_route('orders.index')->with('success', trans('alert.send_license_success'));
    }

    /**
     * apiUpdate
     *
     * @param  mixed $request
     * @param  mixed $invoice_id
     * @return JsonResponse
     */
    public function apiUpdate(Request $request, string $invoice_id): JsonResponse
    {
        $this->service->handleSendLicense($request, $invoice_id);

        return ResponseHelper::success(null, trans('alert.send_license_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return View
     */
    public function history(): View
    {
        $get_invoice_id = $this->transaction->getInvoice();
        if ($get_invoice_id) {
            $invoice_id = substr($get_invoice_id->invoice_id, -4);
        } else {
            $invoice_id = null;
        }
        return view('dashboard.pages.orders.history', ['invoice_id' => $invoice_id]);
    }
    /**
     * Method income
     *
     * @return View
     */
    public function income(): View
    {
        $get_invoice_id = $this->transaction->getInvoice();
        if ($get_invoice_id) {
            $invoice_id = substr($get_invoice_id->invoice_id, -4);
        } else {
            $invoice_id = null;
        }
        return view('dashboard.pages.orders.income', ['invoice_id' => $invoice_id]);

    }
    /**
     * Method pendingHistories
     *
     * @return View
     */
    public function pendingHistories(): View
    {
        $get_invoice_id = $this->transaction->getInvoice();
        if ($get_invoice_id) {
            $invoice_id = substr($get_invoice_id->invoice_id, -4);
        } else {
            $invoice_id = null;
        }
        return view('dashboard.pages.orders.pending', ['invoice_id' => $invoice_id]);
    }
}
