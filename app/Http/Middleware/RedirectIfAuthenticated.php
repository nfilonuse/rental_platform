<?php

namespace HertzApi\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
	    	if (session()->has('from'))
    		{
		    	$backurl=session()->get('from');
    		}
    		else
	    	{
    			$backurl='/account';
    		}
            return redirect($backurl);
        }

        return $next($request);
    }
}
