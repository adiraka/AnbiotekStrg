<?php

namespace Anbiotek\Http\Middleware;

use Closure;
use Sentinel;

class SentinelRedirIfAuth
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        if (Sentinel::check()) {
            return redirect('/');
        }
        return $next($request);
    }
}
