<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\BalanceWithdrawalInterface;
use Illuminate\Http\Request;

class AdminWithdrawalController extends Controller
{

    private static BalanceWithdrawalInterface $withdrawal;

    public function __construct(BalanceWithdrawalInterface $withdrawal){
        $this->withdrawal=$withdrawal;
    }

    public function index(Request $request)
    {
        return view('dashboard.pages.admin-withdrawal.index');
    }
    public function getAjax()
    {

    }
}
