<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\TransactionInterface;
use App\Helpers\ResponseHelper;
use App\Services\CallbackService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CallbackController extends Controller
{
    private TransactionInterface $transaction;
    private CallbackService $service;

    public function __construct(TransactionInterface $transaction, CallbackService $service)
    {
        $this->transaction = $transaction;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */

    public function invoiceCallback(Request $request): JsonResponse
    {
        $find = $this->service->handleRetrieveInvoiceFromXendit($request->id);
        $data = $this->transaction->show($request->external_id);

        if ($request->amount == $request->paid_amount) {
            $this->service->handlePaidInvoice($find, $data);
        } else {
            $this->service->handleExpiredInvoice($find, $data);
        }

        return ResponseHelper::success(null, trans('alert.callback_success'));
    }

    /**
     * Display a success page after callback paid from xendit.
     *
     * @param string $invoice_id
     *
     * @return View
     */

    public function showSuccessPage(string $invoice_id): View
    {
        $transaction = $this->transaction->show($invoice_id);

        return view('pages.callbacks.success', compact('transaction'));
    }

    /**
     * Display a failed page after callback paid from tripay.
     *
     * @param string $invoice_id
     *
     * @return View
     */

    public function showFailedPage(string $invoice_id): View
    {
        $transaction = $this->transaction->show($invoice_id);

        return view('pages.callbacks.failed', compact('transaction'));
    }
}
