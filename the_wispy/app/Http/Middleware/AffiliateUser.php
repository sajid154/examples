<?php

namespace App\Http\Middleware;

use Closure;

class AffiliateUser
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
        if(auth()->user()->roles->first()->name == 'Agent'){
        
            return $next($request);
        } 
        else{
             abort(404, 'NOT FOUND');
        }
        
    }
}
