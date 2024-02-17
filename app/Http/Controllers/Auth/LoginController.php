<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRoleEnum;
use App\Helpers\ResponseHelper;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Services\Auth\LoginService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    private LoginService $loginService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LoginService $loginService)
    {
        $this->middleware('guest')->except('logout');
        $this->loginService = $loginService;
    }

    /**
     * Show the application's login form.
     *
     * @return View
     */
    public function showLoginForm(): View
    {
        $title = trans('title.login');
        return view('auth.login', compact('title'));
    }


    /**
     * Handle a login request to the application.
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     *
     * @throws ValidationException
     */

    public function login(LoginRequest $request): RedirectResponse
    {
        $this->loginService->handleLoginUser($request);

        if (UserHelper::getUserRole() === UserRoleEnum::ADMIN->value) {
            return to_route('dashboard.index');
        }

        return to_route('home.index');
    }

    /**
     * apiLogin
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function apiLogin(Request $request): JsonResponse
    {
        return $this->loginService->handleLogin($request);
    }
}
