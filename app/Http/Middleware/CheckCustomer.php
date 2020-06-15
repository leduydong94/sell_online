<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckCustomer
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
        if (Auth::check()) {
            if (Auth::isCustomer() && strpos(url()->current(), 'logout') === false ) {
                return redirect()->back();
            }

        return $next($request);
        }
        return redirect()->route('login');
    }
        
}
