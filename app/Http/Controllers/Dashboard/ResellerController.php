<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\ResellerInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResellerController extends Controller
{
    private ResellerInterface $reseller;

    public function __construct(ResellerInterface $reseller)
    {
        $this->reseller = $reseller;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return object
     */

    public function index(Request $request): object
    {
        if ($request->ajax()) return $this->reseller->get();
        return view('dashboard.pages.resellers.index');
    }
    
}
