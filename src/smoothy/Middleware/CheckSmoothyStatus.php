<?php

namespace Smoothy\Middleware;

use Carbon\Carbon;
use Closure;
use Smoothy\Api\Responses\Cache\SmoothyCache;
use Smoothy\Api\Responses\Models\Status\Status;
use Smoothy\Api\Wrapper\SmoothyApi;

class CheckSmoothyStatus
{
    /**
     * @var SmoothyApi
     */
    private $api;

    /**
     * @var SmoothyCache
     */
    private $cache;

    /**
     * CheckSmoothyStatus constructor.
     */
    public function __construct()
    {
        $this->api = new SmoothyApi;
        $this->cache = new SmoothyCache;
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

        /** @var Status $status */
        $status = $this->api
            ->status()
            ->get(smoothy_api('status'), $this->getTimestamp())
            ->cache(5, 'smoothy-status')
            ->fetch();

        $this->setTimestamp(
            $status->getTimestamp()->toDateTimeString()
        );

        $this->cache->tags($status->getApiCalls()->toArray())->flush();

        return $next($request);
    }

    /**
     * @return Carbon
     */
    private function getTimestamp() : Carbon
    {
        return Carbon::parse(
            $this->cache->get(
                'smoothy-status-timestamp',
                '0000-00-00 00:00:00'
            )
        );
    }

    /**
     * @param string $timestamp
     */
    private function setTimestamp(string $timestamp)
    {
        $this->cache->forever(
            'smoothy-status-timestamp',
            $timestamp
        );
    }
}