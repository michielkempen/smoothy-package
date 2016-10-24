<?php

namespace Smoothy\Api\Requests;

use Smoothy\Api\Exceptions\RequestException;
use Smoothy\Api\Responses\ResponseFetcher;
use Smoothy\Api\Responses\Transformers\Transformer;

class SmoothyApiRequest
{
    /**
     * @var ApiRequest
     */
    private $request;

    /**
     * @var int
     */
    private $cacheTTL = 0;

    /**
     * @var string
     */
    private $cacheKey = null;

    /**
     * @var bool
     */
    private $force = false;

    /**
     * @var Transformer
     */
    private $transformer = null;

    /**
     * SmoothyApiRequest constructor.
     */
    public function __construct()
    {
        $this->request = new ApiRequest;

        $this
            ->scheme(smoothy_config('api-scheme'))
            ->host(smoothy_config('api-host'))
            ->header('Accept', 'application/vnd.smoothy.v1+json')
            ->header('Authorization', 'Bearer '.smoothy_api_access_token())
            ->cache(60 * 24 * 7);
    }

    /**
     * @throws RequestException
     */
    public function fetch()
    {
        if(is_null($this->request->getMethod()))
            throw RequestException::noMethodSet();

        return (new ResponseFetcher)->fetch($this);
    }

    /**
     * Overwrite the default scheme for the request.
     *
     * @param string $scheme
     * @return SmoothyApiRequest $this
     */
    public function scheme(string $scheme= null) : SmoothyApiRequest
    {
        $this->request->scheme($scheme);
        return $this;
    }

    /**
     * Overwrite the default host for the request.
     *
     * @param string $host
     * @return SmoothyApiRequest $this
     */
    public function host(string $host = null) : SmoothyApiRequest
    {
        $this->request->host($host);
        return $this;
    }

    /**
     * Set the request method to GET.
     *
     * @param string $uri
     * @return SmoothyApiRequest $this
     */
    public function get(string $uri) : SmoothyApiRequest
    {
        $this->request->get($uri);
        return $this;
    }

    /**
     * Set the request method to POST.
     *
     * @param string $uri
     * @return SmoothyApiRequest $this
     */
    public function post(string $uri) : SmoothyApiRequest
    {
        $this->request->post($uri);
        return $this;
    }

    /**
     * Set the request method to DELETE.
     *
     * @param string $uri
     * @return SmoothyApiRequest $this
     */
    public function delete(string $uri) : SmoothyApiRequest
    {
        $this->request->delete($uri);
        return $this;
    }

    /**
     * Append a parameter to the uri of the request.
     *
     * @param string $key
     * @param $value
     * @return SmoothyApiRequest $this
     */
    public function parameter(string $key, $value) : SmoothyApiRequest
    {
        $this->request->parameter($key, $value);
        return $this;
    }

    /**
     * Append a parameter to the uri of the request.
     *
     * @param string $key
     * @param $value
     * @return SmoothyApiRequest $this
     */
    public function header(string $key, $value) : SmoothyApiRequest
    {
        $this->request->header($key, $value);
        return $this;
    }

    /**
     * Set form data to the request.
     *
     * @param array $data
     * @return SmoothyApiRequest $this
     */
    public function data(array $data) : SmoothyApiRequest
    {
        $this->request->data($data);
        return $this;
    }

    /**
     * @param int $minutes
     * @param string $key
     * @return SmoothyApiRequest $this
     */
    public function cache(int $minutes, string $key = null) : SmoothyApiRequest
    {
        $this->cacheTTL = $minutes;
        $this->cacheKey = $key;
        return $this;
    }

    /**
     * @return SmoothyApiRequest $this
     */
    public function force() : SmoothyApiRequest
    {
        $this->force = true;
        return $this;
    }

    /**
     * @param Transformer $transformer
     * @return SmoothyApiRequest $this
     */
    public function transform(Transformer $transformer) : SmoothyApiRequest
    {
        $this->transformer = $transformer;
        return $this;
    }

    /**
     * @return ApiRequest
     */
    public function getRequest(): ApiRequest
    {
        return $this->request;
    }

    /**
     * @return int
     */
    public function getCacheTTL(): int
    {
        return $this->cacheTTL;
    }

    /**
     * @return string|null
     */
    public function getCacheKey()
    {
        return $this->cacheKey;
    }

    /**
     * @return boolean
     */
    public function isForced(): bool
    {
        return $this->force;
    }

    /**
     * @return Transformer|null
     */
    public function getTransformer()
    {
        return $this->transformer;
    }
}