<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\TransactionInterface;
use App\Contracts\Interfaces\UpdateIdInvoiceInterface;
use App\Helpers\ResponseHelper;
use App\Http\Requests\UpdateIdInvoiceRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UpdateIdInvoiceController extends Controller
{
    private UpdateIdInvoiceInterface $updateIdInvoice;
    private TransactionInterface $transaction;

    public function __construct(UpdateIdInvoiceInterface $updateIdInvoice, TransactionInterface $transaction)
    {
        $this->updateIdInvoice = $updateIdInvoice;
        $this->transaction = $transaction;
    }

    /**
     * create
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function create(UpdateIdInvoiceRequest $request)
    {
        $invoice_id = $this->transaction->getInvoice();
        $invoice_id = substr($invoice_id->invoice_id, -4);
        if ($request->new_invoice <= $invoice_id) {
            return redirect()->back()->withErrors("jangan menginputkan kode lebih kecil dari kode sebelumnnya!!!");
        }
        $this->updateIdInvoice->store($request->validated());
        return redirect()->back()->with('success', trans('alert.add_success'));
    }
}
