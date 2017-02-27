<?php

namespace Smoothy\Api\Responses\Cache;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Contracts\Cache\Repository;
use Smoothy\Api\Requests\RequestParser;
use Smoothy\Api\Requests\SmoothyApiRequest;

class ResponseCache
{
    /**
     * @var RequestHasher
     */
    protected $hasher;

    /**
     * @var ResponseSerializer
     */
    protected $serializer;

    /**
     * @var RequestParser
     */
    private $requestParser;

    /**
     * @var Repository
     */
    private $cache;

    /**
     * ResponseCache constructor.
     */
    public function __construct()
    {
        $this->cache = app(Repository::class);
        $this->hasher = new RequestHasher;
        $this->requestParser = new RequestParser;
        $this->serializer = new ResponseSerializer;
    }

    /**
     * @param SmoothyApiRequest $request
     * @return bool
     */
    public function isCacheable(SmoothyApiRequest $request) : bool
    {
        return $request->getRequest()->getMethod() == 'GET';
    }

    /**
     * Store the given response in the cache.
     *
     * @param SmoothyApiRequest $request
     * @param Response $response
     * @param int $minutes
     * @param string $key
     * @return $this
     */
    public function cacheResponse(SmoothyApiRequest $request, Response $response, int $minutes, string $key = null)
    {
        $request = $this->requestParser->parse($request->getRequest());

        $this->cache->put(
            $this->getCacheKey($request, $key),
            $this->serializer->serialize($response),
            Carbon::now()->addMinutes($minutes)
        );

        return $this;
    }

    /**
     * Get the cached response for the given request.
     *
     * @param SmoothyApiRequest $request
     * @return Response|null
     */
    public function getCachedResponseFor(SmoothyApiRequest $request)
    {
        $key = $request->getCacheKey();

        $request = $this->requestParser->parse($request->getRequest());

        $response = $this->cache->get($this->getCacheKey($request, $key));

        return is_null($response) ? null : $this->serializer->unserialize($response);
    }

    /**
     * @param Request $request
     * @param string|null $key
     * @return string
     */
    private function getCacheKey(Request $request, string $key = null) : string
    {
        return is_null($key)
            ? 'smoothy::'.config('smoothy.license-id').'::'.$this->hasher->getHashFor($request)
            : $key;
    }
}