<?php

namespace App\Http\Middleware;

use Closure;
use Route;

class AdminBase
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
        if (!$request->session()->has('adminuser')) {
            return redirect('jksm');
        }
        $route = Route::currentRouteName();

        if (!in_array($route, ['jksm', 'AdminIndex','adminmain'])) {
            if (is_array(session('route'))) {
                if (!in_array($route, session('route'))) {
                    return back()->with('error', '没有权限操作,请联系管理员.');
                }
            }
        }
        return $next($request);
    }
}
