<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\AdminWithdrawalInterface;
use App\Contracts\Interfaces\BalanceWithdrawalInterface;
use App\Contracts\Interfaces\RekeningNumberInterface;
use App\Enums\UserRoleEnum;
use App\Helpers\ResponseHelper;
use App\Helpers\TransactionAffiliateHelper;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BalanceWithdrawalRequest;
use App\Http\Requests\DisapproveBalanceWithdrawalRequest;
use App\Http\Requests\ProofBalanceWithdrawalRequest;
use App\Mail\BalanceWithdrawalMail;
use App\Models\BalanceWithdrawal;
use App\Models\RekeningNumber;
use App\Services\ProofBalanceWithdrawalService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BalanceWithdrawalController extends Controller
{
    private BalanceWithdrawalInterface $balanceWithdrawal;
    private RekeningNumberInterface $rekeningNumber;
    private ProofBalanceWithdrawalService $service;
    public function __construct(BalanceWithdrawalInterface $balanceWithdrawal, RekeningNumberInterface $rekeningNumber, ProofBalanceWithdrawalService $service)
    {
        $this->balanceWithdrawal = $balanceWithdrawal;
        $this->rekeningNumber = $rekeningNumber;
        $this->service = $service;
    }
    /**
     * index
     *
     * @return View
     */
    public function index(Request $request): View|JsonResponse
    {
        if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value) {
            $rekeningNumbers = $this->rekeningNumber->get();
            $pin = auth()->user()->pinRekening ? auth()->user()->pinRekening->pin : null;
            $pin = substr($pin, 0, -4);
            return view('dashboard.pages.reseller-dashboard.balance-withdraws.index', compact('pin', 'rekeningNumbers'));
        } else {
            if ($request->ajax())
                return $this->balanceWithdrawal->search($request);
            return view('dashboard.pages.admin-withdrawal.index');
        }
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(BalanceWithdrawalRequest $request, RekeningNumber $rekeningNumber): RedirectResponse
    {
        $data = $request->validated();
        $saldo = TransactionAffiliateHelper::profit()['saldo'];
        if ($data['balance'] > $saldo) {
            return redirect()->back()->withErrors('Saldo anda tidak cukup');
        }
        $data['status'] = 0;
        $data['rekening_number_id'] = $rekeningNumber->id;
        $this->balanceWithdrawal->store($data);
        return redirect()->back()->with('success', 'permintaan penarikan saldo anda telah dikirim. Jika dalam 2 hari saldo anda masih belum masuk silahkan hubungi admin');
    }

    /**
     * history
     *
     * @return View
     */
    public function history(Request $request): View|JsonResponse
    {
        if ($request->ajax())
            return $this->balanceWithdrawal->getHistories($request);
        return view('dashboard.pages.reseller-dashboard.balance-withdraws.history');
    }

    /**
     * indexAdmin
     *
     * @param  mixed $request
     * @return void
     */
    public function indexAdmin(Request $request)
    {
        return view('dashboard.pages.admin-withdrawal.index');
    }

    /**
     * historyAdmin
     *
     * @param  mixed $request
     * @return View
     */
    public function historyAdmin(Request $request): View|JsonResponse
    {
        if ($request->ajax())
            return $this->balanceWithdrawal->getHistory();
        return view('dashboard.pages.admin-withdrawal.history');
    }

    /**
     * update
     *
     * @return JsonResponse
     */
    public function update(ProofBalanceWithdrawalRequest $request, BalanceWithdrawal $balance_withdrawal): RedirectResponse
    {
        $balance_withdrawal->update($this->service->store($request));
        return redirect()->back()->with('success', trans('alert.update_success'));
    }
    /**
     * Method disapprove
     *
     * @param DisapproveBalanceWithdrawalRequest $request [explicite description]
     * @param BalanceWithdrawal $balance_withdrawal [explicite description]
     * @param mixed $status [explicite description]
     *
     * @return RedirectResponse
     */
    public function disapprove(DisapproveBalanceWithdrawalRequest $request,BalanceWithdrawal $balance_withdrawal):RedirectResponse{
        $data=$request->validated();
        $balance_withdrawal->update($data);
        return redirect()->back()->with('success',trans('alert.update_success'));
    }
}
