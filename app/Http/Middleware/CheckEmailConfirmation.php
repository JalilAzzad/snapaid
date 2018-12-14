<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckEmailConfirmation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = User::findOrFail(Auth::guard($guard)->id());
            if(!(bool) $user->is_confirmed)
            {
                return redirect('/emailconfirm');
            }
        } else {
            return redirect('/login');
        }

        return $next($request);
    }
}
