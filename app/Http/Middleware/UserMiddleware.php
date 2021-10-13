<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!is_null(request()->user())) {
            if(Auth::user()->role == "USER"){
                /* 
                silahkan modifikasi pada bagian ini
                apa yang ingin kamu lakukan jika rolenya tidak sesuai
                */
                return $next($request);
            }
            return redirect()->to('unauthorized-page');
        } else {
            return redirect('login');
        }
      
    }
}
