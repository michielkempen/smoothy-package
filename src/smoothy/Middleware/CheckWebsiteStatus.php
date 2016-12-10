<?php

namespace Smoothy\Middleware;

use Closure;
use Smoothy\Api\Wrapper\SmoothyApi;

class CheckWebsiteStatus
{
    /**
     * @var SmoothyApi
     */
    private $api;

    /**
     * CheckSmoothyStatus constructor.
     */
    public function __construct()
    {
        $this->api = new SmoothyApi;
    }

    /**
     * @param $request
     * @param Closure $next
     * @param null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(smoothy_api_needs_setup())
            return $next($request);

        $website = $this->api
            ->website()
            ->get(smoothy_api('website.module_id'))
            ->fetch();

        switch ($website->getStatus())
        {
            case 'redirect':
                return redirect()->to($website->getRedirectUri());
            case 'offline':
                return abort(503);
            default:
                return $next($request);
        }
    }
}