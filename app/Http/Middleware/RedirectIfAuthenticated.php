<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();

                if ($user->role === 'admin') {
                    return redirect()->intended(route('admin.dashboard'));
                } elseif ($user->role === 'teknisi') {
                    return redirect()->intended(route('teknisi.dashboard'));
                } elseif ($user->role === 'customer') {
                    return redirect()->intended(route('customer.dashboard'));
                }

                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
