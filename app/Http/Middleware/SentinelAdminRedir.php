<?php

namespace Anbiotek\Http\Middleware;

use Closure;
use Sentinel;

class SentinelAdminRedir
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
        if (Sentinel::check()) {
            $user = Sentinel::getUser();
            $role = Sentinel::findRoleBySlug('admin');
            if ($user->inRole($role)) {
                return redirect()->intended('admin');
            }
        }
        return $next($request);
    }
}
