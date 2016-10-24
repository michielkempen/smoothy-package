<?php

namespace Smoothy\Api\Setup\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetupSmoothyApi
{
    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param  Closure $next
     * @param  string|null $guard
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(smoothy_config('api-enabled') && smoothy_api_needs_setup())
        {
            $query = http_build_query([
                'client_id' => smoothy_config('api-client-id'),
                'redirect_uri' => url('/api-callback'),
                'response_type' => 'code',
                'scope' => ''
            ]);

            $scheme = smoothy_config('app-scheme');
            if($scheme == null)
                throw new \Exception('No API scheme set.');

            $host = smoothy_config('app-host');
            if($host == null)
                throw new \Exception('No API host set.');

            $url = $scheme.'://'.rtrim($host, '/').'/authorize?'.$query;

            return redirect($url);
        }

        return $next($request);
    }
}