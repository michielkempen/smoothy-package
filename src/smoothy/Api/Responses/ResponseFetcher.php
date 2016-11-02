<?php

namespace Smoothy\Api\Responses;

use Smoothy\Api\Responses\Cache\ResponseCache;
use Smoothy\Api\Requests\RequestSender;
use Smoothy\Api\Requests\SmoothyApiRequest;

class ResponseFetcher
{
    /**
     * @var ResponseCache
     */
    private $cache;

    /**
     * @var RequestSender
     */
    private $requestSender;

    /**
     * @var ResponseParser
     */
    private $responseParser;

    /**
     * ResponseFetcher constructor.
     */
    public function __construct()
    {
        $this->cache = new ResponseCache;
        $this->requestSender = new RequestSender;
        $this->responseParser = new ResponseParser;
    }

    /**
     * @param SmoothyApiRequest $request
     * @return mixed
     */
    public function fetch(SmoothyApiRequest $request)
    {
        $response = $this->cache->isCacheable($request)
            ? $this->fetchCacheableResponse($request)
            : $this->fetchUnCacheableResponse($request);

        $response = $this->responseParser->parse($response, $request);

        return $response;
    }

    /**
     * @param SmoothyApiRequest $request
     * @return mixed
     */
    private function fetchCacheableResponse(SmoothyApiRequest $request)
    {
        // if the request is cacheable and not forced to be sent
        if(!$request->isForced())
        {
            // try to get the response from the cache
            $response = $this->cache->getCachedResponseFor($request);

            // if the response is fetched from the cache
            if(!is_null($response))
                return $response;
        }

        // fetch new response
        $response = $this->requestSender->send($request);

        // cache the response for the provided time
        if($request->getCacheTTL() > 0)
        {
            $this->cache->cacheResponse(
                $request,
                $response,
                $request->getCacheTTL(),
                $request->getCacheKey()
            );

            $response = $this->cache->getCachedResponseFor($request);
        }

        return $response;
    }

    /**
     * @param SmoothyApiRequest $request
     * @return mixed
     */
    private function fetchUnCacheableResponse(SmoothyApiRequest $request)
    {
        return $this->requestSender->send($request);
    }
}