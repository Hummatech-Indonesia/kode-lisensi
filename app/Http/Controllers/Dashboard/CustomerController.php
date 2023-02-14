<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\CustomerInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private CustomerInterface $customer;

    public function __construct(CustomerInterface $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return object
     */
    public function index(Request $request): object
    {
        if ($request->ajax()) return $this->customer->get();

        return view('dashboard.pages.customers.index');
    }
}
