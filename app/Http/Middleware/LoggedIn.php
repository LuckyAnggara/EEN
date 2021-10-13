<?php

namespace App\Http\Middleware;

use Closure;

class LoggedIn
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        if (!is_null(request()->user())) {
            // if(Auth::user()->role ==)
            return redirect('/');
            // return request()->user();
        } else {
            return $next($request);
        }
    }
}
