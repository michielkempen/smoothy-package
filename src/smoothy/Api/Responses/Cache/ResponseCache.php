<?php

namespace Smoothy\Api\Responses\Cache;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Cache\Repository;
use Illuminate\Support\Facades\Cache;
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
     * ResponseCache constructor.
     */
    public function __construct()
    {
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
        $response = $this->addCachedHeader($response);

        $this->getCache($request, $key)->put(
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
     * @param string $key
     * @return Response|null
     */
    public function getCachedResponseFor(SmoothyApiRequest $request, string $key = null)
    {
        $request = $this->requestParser->parse($request->getRequest());

        $response = $this->getCache($request, $key)->get(
            $this->getCacheKey($request, $key),
            null
        );

        return is_null($response)
            ? null
            : $this->serializer->unserialize($response);
    }

    /**
     * Add a header with the cache date on the response.
     *
     * @param Response $response
     * @return Response
     */
    private function addCachedHeader(Response $response)
    {
        $clonedResponse = clone $response;

        return $clonedResponse->withHeader(
            'smoothy-api-cache',
            'cached on '.date('Y-m-d H:i:s')
        );
    }

    /**
     * @param Request $request
     * @param string|null $key
     * @return Repository
     */
    private function getCache(Request $request, string $key = null) : Repository
    {
        return is_null($key)
            ? Cache::tags([$this->getApiCall($request)])
            : Cache::driver();
    }

    /**
     * @param Request $request
     * @return string
     */
    private function getApiCall(Request $request) : string
    {
        return $request->getUri()->getScheme().'://'.$request->getUri()->getHost().$request->getUri()->getPath();
    }

    /**
     * @param Request $request
     * @param string|null $key
     * @return string
     */
    private function getCacheKey(Request $request, string $key = null) : string
    {
        return is_null($key)
            ? $this->hasher->getHashFor($request)
            : $key;
    }
}