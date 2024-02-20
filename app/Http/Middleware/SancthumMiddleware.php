<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SancthumMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $bearer = $request->bearerToken();

        $user = User::where('api_token', $bearer)->first();

        if ($user) {
            Auth::login($user);
            return $next($request);
        }

        return response()->json([
            'success' => false,
            'error' => 'Access denied.',
        ], 401);
    }
}
