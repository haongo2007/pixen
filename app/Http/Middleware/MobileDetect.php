<?php

namespace App\Http\Middleware;

use Closure;
use Jenssegers\Agent\Agent;

class MobileDetect
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
//        $agent = new Agent();
//        if (!$agent->isMobile()) {
//            return abort(403);
//        }
        return $next($request);
    }
}
