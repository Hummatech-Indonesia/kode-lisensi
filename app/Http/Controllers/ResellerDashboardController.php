<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResellerDashboardController extends Controller
{
    public function index(){

    }
    public function history(){
        return view('dashboard.pages.reseller-dashboard.history');
    }
    public function notification(){
        return view('dashboard.pages.reseller-dashboard.notification');
    }
}
