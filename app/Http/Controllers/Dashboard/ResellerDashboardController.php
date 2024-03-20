<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ResellerDashboardController extends Controller
{

    /**
     * history
     *
     * @return View
     */
    public function history(): View
    {
        return view('dashboard.pages.reseller-dashboard.history');
    }

    /**
     * notification
     *
     * @return View
     */
    public function notification(): View
    {
        return view('dashboard.pages.reseller-dashboard.notification');
    }
}
