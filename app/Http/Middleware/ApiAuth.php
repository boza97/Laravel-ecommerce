<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ApiAuth
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
        $credentials = [
            'email' => $request->header('php-auth-user'),
            'password' => $request->header('php-auth-pw')
        ];

        if(auth()->attempt($credentials)){
            return $next($request);
        }

        return response()->json([
            'status' => 'ERROR',
            'msg' => __('auth.failed'),
        ], 401);
    }
}
