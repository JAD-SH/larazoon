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
        /*
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
        */
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            /*
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
            */
            if (Auth::guard($guard)->check()) {
                if ($guard == 'admin')
                    return redirect(RouteServiceProvider::ADMIN)->with([
                        'notifyBtn' => 'btn-successToast','notifyTitle' => 'تسجيل الدخول الى لوحة التحكم','notifyMsg' => 'مرحبا تم الدخول الى لوحة التحكم بنجاح '
                    ]);
                else
                    return redirect(RouteServiceProvider::PROFILE)->with([
                        'notifyBtn' => 'btn-successToast','notifyTitle' => 'تسجيل الدخول الى ملفك','notifyMsg' => 'مرحبا تم الدخول الى ملفك الشخصي بنجاح '
                    ]);
            }
        }

        return $next($request);
    }
}
