<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckAuth
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
        // $this->user= Auth::user();
        if (Auth::check()) {
            return redirect()->back(); 
        } else {
            return $next($request);
        }
    }
}
