<?php

namespace Anbiotek\Http\Middleware;

use Closure;

class SentinelAdminUser
{
    public function handle($request, Closure $next)
    {
        $user = Sentinel::getUser();
        $role = Sentinel::findRoleBySlug('admin');
        if (!$user->inRole($role)) {
            return redirect('login');
        }
        return $next($request);
    }
}
