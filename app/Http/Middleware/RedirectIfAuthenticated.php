<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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
        if (Auth::guard($guard)->check()) {
            switch ($guard) {
                case 'mnre':
                    return redirect()->intended(route('mnre.dashboard'));
                    break;
                case 'gecmnre':
                    return redirect()->intended(route('gecmnre.dashboard'));
                    break;
                case 'state-implementing-agency':
                    return redirect()->intended(route('state-implementing-agency.dashboard'));
                    break;
                case 'localbody':
                    return redirect()->intended(route('localbody.dashboard'));
                    break;
                case 'installer':
                    return redirect()->intended(route('installer.dashboard'));
                    break;
                case 'inspector':
                    return redirect()->intended(route('inspector.dashboard'));
                    break;
                case 'seci':
                    return redirect()->intended(route('seci.testing'));
                    break;
                case 'gecdeveloper':
                    return redirect()->intended(route('gecdeveloper.dashboard'));
                    break;
                case 'stu-users':
                    return redirect()->intended(route('stu-users.progress-report'));
                    break;
                default:
                    return redirect()->intended(RouteServiceProvider::HOME);
                    break;
            }
        }

        return $next($request);
    }
}