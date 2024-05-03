<?php

namespace App\Http\Controllers\Administrator;

use App\Contracts\Interfaces\Administrator\ExpenditureInterface;
use App\Contracts\Interfaces\Administrator\RefundInterface;
use App\Contracts\Interfaces\TransactionAffiliateInterface;
use App\Contracts\Interfaces\TransactionInterface;
use App\Enums\BalanceUsedEnum;
use App\Enums\LicenseStatusEnum;
use App\Enums\StatusRefundEnum;
use App\Enums\UsedForEnum;
use App\Helpers\BalanceHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApproveRefundRequest;
use App\Http\Requests\RefundRequest;
use App\Http\Requests\RejectRequest;
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
    private TransactionInterface $transaction;
    private TransactionAffiliateInterface $transaction_affiliate;
    public function __construct(RefundInterface $refund, RefundService $service, ExpenditureInterface $expenditure, TransactionInterface $transaction, TransactionAffiliateInterface $transaction_affiliate)
    {
        $this->refund = $refund;
        $this->transaction_affiliate = $transaction_affiliate;
        $this->transaction = $transaction;
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
            return $this->refund->search($request);
        return view('dashboard.pages.administrator.refund.my-refund');
    }
    public function getRefundHistories(Request $request): View|JsonResponse
    {
        if ($request->ajax()) return $this->refund->getRefundHistories($request);
        return view('dashboard.pages.administrator.refund.histories');
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

        $transaction = $this->transaction->findNow($refund->transaction_id);
        if ($data['balance_used'] == BalanceUsedEnum::TRIPAY->value) {
            $balance_tripay = BalanceHelper::handleTripayBalance();
            if ($transaction->paid_amount >= $balance_tripay) {
                return redirect()->back()->withErrors('Saldo anda tidak mencukupi');
            }
        } elseif ($data['balance_used'] == BalanceUsedEnum::REKENING->value) {
            $balance_rekening = BalanceHelper::handleWhatsappBalance();
            if ($transaction->paid_amount >= $balance_rekening) {
                return redirect()->back()->withErrors('Saldo anda tidak mencukupi');
            }
        }


        $transaction_affiliate = $this->transaction_affiliate->getWhere(['created_at' => $transaction->created_at]);

        $this->transaction_affiliate->delete($transaction_affiliate->id);

        $transaction->update(['license_status' => LicenseStatusEnum::CANCELED->value]);

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

    /**
     * reject
     *
     * @param  mixed $request
     * @param  mixed $refund
     * @return RedirectResponse
     */
    public function reject(RejectRequest $request, Refund $refund): RedirectResponse
    {
        $data = $request->validated();
        $this->refund->update($refund->id, ['status' => StatusRefundEnum::REJECT->value, 'rejected' => $data['rejected']]);
        return redirect()->back()->with('success', 'Berhasil menolak permintaan');
    }
}
