<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\AdminWithdrawalInterface;
use App\Contracts\Interfaces\BalanceWithdrawalInterface;
use Illuminate\Http\Request;

class AdminWithdrawalController extends Controller
{

    private AdminWithdrawalInterface $balanceWithdrawal;
    public function __construct(AdminWithdrawalInterface $balanceWithdrawal)
    {
        $this->balanceWithdrawal = $balanceWithdrawal;
    }

    public function index(Request $request)
    {
        return view('dashboard.pages.admin-withdrawal.index');
    }
    public function history(Request $request)
    {
        if ($request->ajax())
            return $this->balanceWithdrawal->get();
        return view('dashboard.pages.admin-withdrawal.history');
    }
}
