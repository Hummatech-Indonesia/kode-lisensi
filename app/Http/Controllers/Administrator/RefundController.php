<?php

namespace App\Http\Controllers\Administrator;

use App\Contracts\Interfaces\Administrator\ExpenditureInterface;
use App\Contracts\Interfaces\Administrator\RefundInterface;
use App\Enums\StatusRefundEnum;
use App\Enums\UsedForEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApproveRefundRequest;
use App\Http\Requests\RefundRequest;
use App\Models\Refund;
use App\Models\Transaction;
use App\Services\RefundService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RefundController extends Controller
{

    private RefundInterface $refund;
    private RefundService $service;
    private ExpenditureInterface $expenditure;
    public function __construct(RefundInterface $refund, RefundService $service, ExpenditureInterface $expenditure)
    {
        $this->refund = $refund;
        $this->service = $service;
        $this->expenditure = $expenditure;
    }

    /**
     * index
     *
     * @return View
     */
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax())
            return $this->refund->get();
        return view('dashboard.pages.administrator.refund.index');
    }

    /**
     * getMyRefund
     *
     * @return View
     */
    public function getMyRefund(Request $request): View|JsonResponse
    {
        if ($request->ajax())
            return $this->refund->get();
        return view('dashboard.pages.administrator.refund.my-refund');
    }
    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(RefundRequest $request, Transaction $transaction): RedirectResponse
    {
        $this->refund->store($this->service->store($request, $transaction));
        return redirect()->back()->with('success', trans('alert.add_success'));
    }

    /**
     * approve
     *
     * @param  mixed $refund
     * @return RedirectResponse
     */
    public function approve(Refund $refund, ApproveRefundRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->expenditure->store([
            'balance_used' => $data['balance_used'],
            'used_for' => UsedForEnum::REFUND->value,
            'balance_withdrawn' => $refund->transaction->paid_amount,
            'description' => $data['description']
        ]);

        $service = $this->service->approve($request);
        $this->refund->update($refund->id, ['status' => StatusRefundEnum::ACCEPTED->value, 'proof_admin' => $service['proof_admin']]);
        return redirect()->back()->with('success', 'Berhasil menyetujui permintaan');
    }
}
