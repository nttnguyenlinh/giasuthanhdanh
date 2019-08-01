<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
//        if (Auth::guard()->check()) {
//            return redirect('/');
//        }
        switch ($guard)
        {
            case 'admin':
                if (Auth::guard($guard)->check() || Auth::guard($guard)->viaRemember())
                    return redirect()->intended(route('admin'));
                break;
            default:
                if (Auth::guard($guard)->check() || Auth::guard($guard)->viaRemember())
                    return redirect()->intended(route('giasu'));
                break;
        }
        return $next($request);
    }
}
