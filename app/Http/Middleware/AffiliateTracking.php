<?php

namespace HertzApi\Http\Middleware;

use Closure;

class AffiliateTracking
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
        $response = $next($request);

        if ($request->has('ref')) {
            $response->withCookie(cookie('referral_id', $request->get('ref'), 100));
        }

        return $response;
    }
}
