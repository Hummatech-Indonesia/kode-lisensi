<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\UserInterface;
use App\Enums\UserRoleEnum;
use App\Http\Requests\UserCustomerRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserInterface $user;
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('dashboard.pages.users.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if ($data['password'] == null) {
            $password = bcrypt('password');
        } else {
            $password = bcrypt($data['password']);
        }
        $data['password'] = $password;
        if ($data['role'] == UserRoleEnum::RESELLER->value) {
            $data['code_affiliate'] = strtolower(str_random(7));
        }
        $data['email_verified_at'] = now();
        $user = $this->user->store($data);
        $user->assignRole($data['role']);
        if ($data['role'] == UserRoleEnum::ADMIN->value) {
            return redirect()->route('users.admin.index')->with('success', trans('alert.add_success'));
        } elseif ($data['role'] == UserRoleEnum::RESELLER->value) {
            return redirect()->route('users.reseller.index');
        } elseif ($data['role'] == UserRoleEnum::CUSTOMER->value) {
            return redirect()->route('users.customer.index');
        }
        return redirect()->route('users.author.index')->with('success', trans('alert.add_success'));
    }

    /**
     * admin
     *
     * @return object
     */
    public function admin(Request $request): object
    {
        $data['role'] = [UserRoleEnum::ADMIN->value,UserRoleEnum::AUTHOR->value];
        $data['email_verified_at'] = now();
        if ($request->ajax())
            return $this->user->getWhere($data);
        return view('dashboard.pages.admin.index');
    }

    /**
     * author
     *
     * @return View
     */
    public function author(Request $request): object
    {
        $data['role'] = UserRoleEnum::AUTHOR->value;
        if ($request->ajax())
            return $this->user->getWhere($data);
        return view('dashboard.pages.author.index');
    }

    /**
     * edit
     *
     * @param  mixed $user
     * @return View
     */
    public function edit(User $user): View
    {
        return view('dashboard.pages.users.edit', compact('user'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $user
     * @return RedirectResponse
     */
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();

        $this->user->update($user->id, $data);
        $user->syncRoles($data['role']);
        if ($data['role'] == UserRoleEnum::ADMIN->value) {
            return redirect()->route('users.admin.index')->with('success', trans('alert.add_success'));
        }
        return redirect()->route('users.author.index')->with('success', trans('alert.add_success'));
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
