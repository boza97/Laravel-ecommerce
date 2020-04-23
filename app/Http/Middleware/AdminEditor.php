<?php

namespace App\Http\Middleware;

use Closure;

class AdminEditor
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
        if(!(auth()->user() && in_array(auth()->user()->role, ['ADMIN', 'EDITOR']))) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
