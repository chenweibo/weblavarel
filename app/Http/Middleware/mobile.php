<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Jenssegers\Agent\Agent;

class mobile
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
        $agent = new Agent();
        if ($agent->isMobile()) {
            return redirect('mobile');
        }
        return $next($request);
    }
}
