<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\TransactionInterface;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    private TransactionInterface $transaction;
    private TransactionService $service;

    public function __construct(TransactionInterface $transaction, TransactionService $service)
    {
        $this->transaction = $transaction;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) return $this->transaction->get();
        return view('dashboard.pages.orders.index');
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
        if ($request->ajax()) return $this->transaction->getAll();

        return view('dashboard.pages.orders.index');
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
        return view('dashboard.pages.orders.history');
    }
}
