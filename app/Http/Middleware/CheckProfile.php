<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckProfile
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
        if (Auth::user()->finished_profile == 0) {
            return redirect()->route('profile.edit')->with('error',__('You need to complete your profile to use the service.'));
        }
        return $next($request);
    }
}
