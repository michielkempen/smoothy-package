<?php

namespace Smoothy\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Cache;
use Smoothy\Api\Wrapper\SmoothyApi;

class CheckSmoothyStatus
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
        $status = $this->api
            ->status()
            ->get(smoothy_api('status'), $this->getTimestamp())
            ->cache(5, $this->getCacheKey())
            ->fetch();

        $this->setTimestamp(
            $status->getTimestamp()->toDateTimeString()
        );

        Cache::tags($status->getApiCalls()->toArray())->flush();

        return $next($request);
    }

    /**
     * @return string
     */
    private function getCacheKey()
    {
        return 'smoothy-status-'.smoothy_config('api-client-id');
    }

    /**
     * @return Carbon
     */
    private function getTimestamp() : Carbon
    {
        return Carbon::parse(
            Cache::get(
                'smoothy-status-timestamp-'.smoothy_config('api-client-id'),
                '0000-00-00 00:00:00'
            )
        );
    }

    /**
     * @param string $timestamp
     */
    private function setTimestamp(string $timestamp)
    {
        Cache::forever(
            'smoothy-status-timestamp-'.smoothy_config('api-client-id'),
            $timestamp
        );
    }
}