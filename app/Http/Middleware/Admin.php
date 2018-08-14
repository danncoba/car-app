<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
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
        if (Auth::check() && Auth::user()->type == 'admin')
        {
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->type == 'member')
        {
            return response('Not member', 403);
        }
        else
        {
            return response('Not authenticated', 401);
        }
    }
}
