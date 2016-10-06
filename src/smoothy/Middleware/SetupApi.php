<?php

namespace Smoothy\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetupApi
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
        if (!apiIsSetup())
        {
            $query = http_build_query([
                'client_id' => env('SMOOTHY_API_CLIENT_ID'),
                'redirect_uri' => url('/api-callback'),
                'response_type' => 'code',
                'scope' => ''
            ]);

            $scheme = env('SMOOTHY_API_SCHEME');
            if($scheme == null)
                throw new \Exception('No API scheme set.');

            $host = env('SMOOTHY_API_HOST');
            if($host == null)
                throw new \Exception('No API host set.');

            $url = $scheme.'://'.rtrim($host, '/').'/authorize?'.$query;

            return redirect($url);
        }

        return $next($request);
    }
}