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
                    return  redirect()->route('admin.home');
                } else if (Auth::user()->isA('storekeeper')) {
                    return  redirect()->route('store.home');
                } else if (Auth::user()->isA('muhasibu')) {
                    return  redirect()->route('muhasibu.home');
                } else if (Auth::user()->isA('manager')) {
                    return  redirect()->route('manager.home');
                } else {
                    return  redirect()->route('driver.home');
                }
            }
        }

        return $next($request);
    }
}
