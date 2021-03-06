<?php

namespace App\Http\Middleware;

use Closure;

class EnsureRequestWantJson
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->headers->set('Access-Control-Allow-Origin', 'http://www.cms.tnguyenofficial.com');
        $request->headers->set('Access-Control-Allow-Methods', '*');
        $request->headers->set('Access-Control-Allow-Headers', '*');

        if ($request->is('*')) {

            if ($request->get('Accept') == 'application/json') {
                return $next($request);
            }
            $request->headers->set('Accept', 'application/json');
        }
        return $next($request);
    }
}
