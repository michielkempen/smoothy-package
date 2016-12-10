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
            if($request->route()->getName() == 'api-callback')
                return $next($request);

            $query = http_build_query([
                'client_id' => smoothy_config('api-client-id'),
                'redirect_uri' => route('api-callback'),
                'response_type' => 'code',
                'scope' => 'license-'.smoothy_config('license-id')
            ]);

            $scheme = smoothy_config('app-scheme');
            if($scheme == null)
                throw new \Exception('No APP scheme set.');

            $host = smoothy_config('app-host');
            if($host == null)
                throw new \Exception('No APP host set.');

            $url = $scheme.'://'.rtrim($host, '/').'/authorize?'.$query;

            return redirect($url);
        }

        return $next($request);
    }
}