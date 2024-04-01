<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\CustomerInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCustomerRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private CustomerInterface $customer;
    private UserInterface $user;

    public function __construct(CustomerInterface $customer, UserInterface $user)
    {
        $this->customer = $customer;
        $this->user = $user;
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
    /**
     * updateCustomer
     *
     * @param  mixed $request
     * @param  mixed $user
     * @return RedirectResponse
     */
    public function update(UserCustomerRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();
        $this->user->update($user->id, $data);
        return redirect()->back()->with('success', trans('alert.update_success'));
    }

    /**
     * delete
     *
     * @param  mixed $user
     * @return RedirectResponse
     */
    public function delete(User $user): RedirectResponse
    {
        $this->user->delete($user->id);
        return redirect()->back();
    }
}
