<?php

namespace App\Services\Auth;

use App\Helpers\ResponseHelper;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;

class LoginService
{
    public function __construct()
    {
    }

    /**
     * Handle a login request to the application.
     *
     * @param LoginRequest $request
     * @return void
     *
     * @throws ValidationException
     */

    public function handleLoginUser(LoginRequest $request): void
    {
        $request->validated();

        if (!auth()->attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }
    }

    /**
     * handleLogin
     *
     * @param  mixed $request
     * @return mixed
     */
    public function handleLogin(LoginRequest $request): mixed
    {
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            if (auth()->user()->roles->pluck('name')[0] == 'head master' && !auth()->user()->school->is_verified) {
                return ResponseHelper::error(null, trans('alert.account_unverified'), Response::HTTP_FORBIDDEN);
            }
            $data['token'] =  auth()->user()->createToken('auth_token')->plainTextToken;
            $data['user'] = UserResource::make(auth()->user());
            return ResponseHelper::success($data, trans('alert.login_success'));
        }

        return ResponseHelper::error(null, trans('alert.password_or_email_false'), Response::HTTP_BAD_REQUEST);
    }
}
