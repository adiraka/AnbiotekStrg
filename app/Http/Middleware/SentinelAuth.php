<?php

namespace Anbiotek\Http\Middleware;

use Closure;

class SentinelAuth
{
    public function handle($request, Closure $next)
    {
        if (!Sentinel::check()) {
            if ($request->ajax()) {
                return response('Unauthorized', 401);
            } else {
                return redirect()->guest('login');
            }
        }
        return $next($request);
    }
}
