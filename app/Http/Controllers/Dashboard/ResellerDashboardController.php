<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\TransactionAffiliateInterface;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResellerDashboardController extends Controller
{

    private TransactionAffiliateInterface $transactionAffiliate;

    public function __construct(TransactionAffiliateInterface $transactionAffiliate)
    {
        $this->transactionAffiliate = $transactionAffiliate;
    }

    /**
     * history
     *
     * @return View
     */
    public function profit(Request $request): JsonResponse|View
    {
        if ($request->ajax()) return $this->transactionAffiliate->get();
        return view('dashboard.pages.reseller-dashboard.profit.index');
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
