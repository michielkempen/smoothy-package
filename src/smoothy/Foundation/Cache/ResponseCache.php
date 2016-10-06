<?php

namespace Smoothy\Foundation\Cache;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Cache\Repository;

class ResponseCache
{
    /**
     * @var Repository
     */
    protected $cache;

    /**
     * @var RequestHasher
     */
    protected $hasher;

    /**
     * @var ResponseSerializer
     */
    protected $serializer;

    /**
     * ResponseCache constructor.
     */
    public function __construct()
    {
        $this->cache = app('cache')->store(config('cache.default'));
        $this->hasher = app(RequestHasher::class);
        $this->serializer = app(ResponseSerializer::class);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function isCacheable(Request $request) : bool
    {
        return $request->getMethod() == 'GET';
    }

    /**
     * Store the given response in the cache.
     *
     * @param Request $request
     * @param Response $response
     * @param int $minutes
     * @return $this
     */
    public function cacheResponse(Request $request, Response $response, int $minutes)
    {
        $response = $this->addCachedHeader($response);

        $this->cache->put(
            $this->hasher->getHashFor($request),
            $this->serializer->serialize($response),
            Carbon::now()->addMinutes($minutes)
        );

        return $this;
    }

    /**
     * Get the cached response for the given request.
     *
     * @param Request $request
     * @return Response|null
     */
    public function getCachedResponseFor(Request $request)
    {
        $response = $this->cache->get(
            $this->hasher->getHashFor($request),
            null
        );

        return $response == null
            ? null
            : $this->serializer->unserialize($response);
    }

    /**
     *  Flush the cache.
     */
    public function flush()
    {
        $this->cache->flush();
    }

    /**
     * Add a header with the cache date on the response.
     *
     * @param Response $response
     * @return Response
     */
    protected function addCachedHeader(Response $response)
    {
        $clonedResponse = clone $response;

        return $clonedResponse->withHeader(
            'smoothy-api-cache',
            'cached on '.date('Y-m-d H:i:s')
        );
    }
}