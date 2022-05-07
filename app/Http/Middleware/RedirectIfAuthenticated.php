<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (Auth::user()->isA('superadmin')) {
                    return  '/superadmin';
                } else if (Auth::user()->isA('storekeeper')) {
                    return  '/dashboard';
                } else if (Auth::user()->isA('muhasibu')) {
                    return  '/muhasibu';
                } else if (Auth::user()->isA('manager')) {
                    return  '/manager';
                } else if (Auth::user()->isA('driver')) {
                    return  '/dashboard';
                } else {
                    abort(403);
                }
            }
        }

        return $next($request);
    }
}
