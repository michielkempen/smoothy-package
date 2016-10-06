<?php

namespace Smoothy\Middleware;

use Closure;
use Smoothy\Api\SmoothyApi;

class CheckWebsiteStatus
{
    public function handle($request, Closure $next, $guard = null)
    {
        $website = (new SmoothyApi)->website()->get(
            smoothy_config('website.module_id')
        );

        switch ($website->getStatus())
        {
            case 'redirect':
                return redirect()->to($website->getRedirectUri());
            case 'offline':
                return response()->view('errors.503');
            default:
                return $next($request);
        }
    }
}