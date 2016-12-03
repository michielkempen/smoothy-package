<?php

namespace Smoothy\Middleware;

use Closure;

class ValidProxies
{
    /**
     * Laravel depends on some http headers to define whether to use TLS for its
     * url() and route() function. Since websites behind a load balancer are not
     * secure, we have to accept the http headers from the load balancer. This
     * can be done using this middleware.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->setTrustedProxies([ $request->getClientIp() ]);

        return $next($request);
    }
}