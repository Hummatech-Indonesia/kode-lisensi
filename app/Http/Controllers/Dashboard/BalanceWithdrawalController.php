<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\AdminWithdrawalInterface;
use App\Contracts\Interfaces\BalanceWithdrawalInterface;
use App\Enums\UserRoleEnum;
use App\Helpers\TransactionAffiliateHelper;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BalanceWithdrawalRequest;
use App\Mail\BalanceWithdrawalMail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BalanceWithdrawalController extends Controller
{
    private BalanceWithdrawalInterface $balanceWithdrawal;
    private AdminWithdrawalInterface $adminWithdrawal;
    public function __construct(BalanceWithdrawalInterface $balanceWithdrawal, AdminWithdrawalInterface $adminWithdrawal)
    {
        $this->balanceWithdrawal = $balanceWithdrawal;
        $this->adminWithdrawal = $adminWithdrawal;
    }
    /**
     * index
     *
     * @return View
     */
    public function index(Request $request): View|JsonResponse
    {
        if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value) {
            $pin = auth()->user()->pinRekening->pin;
            $pin = substr($pin, 0, -4);
            return view('dashboard.pages.reseller-dashboard.balance-withdraws.index', compact('pin'));
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
    public function store(BalanceWithdrawalRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $saldo = TransactionAffiliateHelper::profit()['saldo'];
        if ($data['balance'] >= $saldo) {
            return redirect()->back()->withErrors('Saldo anda tidak cukup wkwk');
        }
        $data['status'] = 0;
        $this->balanceWithdrawal->store($data);
        Mail::to(config('mail.notify_preorder'))->send(new BalanceWithdrawalMail([
            'user' => auth()->user(),
            'via' => $data['via'],
            'balance' => $data['balance'],
            'time' => now(),
        ]));
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

    public function indexAdmin(Request $request)
    {
        return view('dashboard.pages.admin-withdrawal.index');
    }
    public function historyAdmin(Request $request): View|JsonResponse
    {
        if ($request->ajax())
            return $this->balanceWithdrawal->getHistory();
        return view('dashboard.pages.admin-withdrawal.history');
    }


}
