<?php

namespace App\Http\Middleware;

use Closure;

if(!isset($_SESSION)){
    session_start();
}

class Login
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
        if(empty($_SESSION)){
            return redirect(route('login'))->with('error', 'You must be connected to access to your account !');
        }
        
        return $next($request);
    }
}
