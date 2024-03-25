<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\BalanceWithdrawalInterface;
use Illuminate\Http\Request;

class AdminWithdrawalController extends Controller
{

    public function index(Request $request)
    {
        return view('dashboard.pages.admin-withdrawal.index');
    }
    public function getAjax()
    {

    }
}
