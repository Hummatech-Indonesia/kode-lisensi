<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Interfaces\RegisterInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Providers\RouteServiceProvider;
use App\Services\Auth\RegisterService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;

    private RegisterService $registerService;
    private RegisterInterface $register;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RegisterService $registerService, RegisterInterface $register)
    {
        $this->middleware('guest');
        $this->registerService = $registerService;
        $this->register = $register;
    }

    /**
     * Show the application registration form.
     *
     * @return View
     */
    public function showRegistrationForm(): View
    {
        $title = trans('title.register');
        return view('auth.register', compact('title'));
    }


    /**
     * Handle school registration form
     *
     * @param RegisterRequest $request
     *
     * @return RedirectResponse
     */

    public function register(RegisterRequest $request): RedirectResponse
    {
        $this->registerService->handleRegistration($request, $this->register);

        return back()->with('success', trans('auth.register_success'));
    }
}
