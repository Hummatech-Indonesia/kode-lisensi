<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\BalanceWithdrawalInterface;
use App\Helpers\TransactionAffiliateHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BalanceWithdrawalRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BalanceWithdrawalController extends Controller
{
    private BalanceWithdrawalInterface $balanceWithdrawal;

    public function __construct(BalanceWithdrawalInterface $balanceWithdrawal)
    {
        $this->balanceWithdrawal = $balanceWithdrawal;
    }
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        return view('dashboard.pages.reseller-dashboard.balance-withdraws.index');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(BalanceWithdrawalRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $saldo = TransactionAffiliateHelper::profit()['saldo'];
        if ($data['balance'] >= $saldo) {
            return redirect()->back()->withErrors('Saldo anda tidak cukup wkwk');
        }
        $data['status'] = 0;
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
            return $this->balanceWithdrawal->get();
        return view('dashboard.pages.reseller-dashboard.balance-withdraws.history');
    }
}
