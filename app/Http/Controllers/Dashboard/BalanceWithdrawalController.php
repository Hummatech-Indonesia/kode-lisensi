<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BalanceWithdrawalController extends Controller
{
    public function index(): View
    {
        return view('dashboard.pages.reseller-dashboard.balance-withdraws.index');
    }
}
