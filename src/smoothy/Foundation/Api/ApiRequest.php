<?php

namespace Smoothy\Foundation\Api;

class ApiRequest
{
    /**
     * @var string http|https
     */
    private $scheme = 'http';

    /**
     * @var string
     */
    private $host = null;

    /**
     * @var string
     */
    private $method = null;

    /**
     * @var string
     */
    private $path = null;

    /**
     * @var array
     */
    private $data = array();

    /**
     * @var array
     */
    private $headers = array();

    /**
     * @var array
     */
    private $parameters = array();

    /**
     * @var int
     */
    private $cache = 0;

    /**
     * @var bool
     */
    private $force = false;

    /**
     * Overwrite the default scheme for the request.
     *
     * @param string $scheme
     * @return ApiRequest $this
     */
    public function scheme(string $scheme= null) : ApiRequest
    {
        $this->scheme = $scheme;
        return $this;
    }

    /**
     * Overwrite the default host for the request.
     *
     * @param string $host
     * @return ApiRequest $this
     */
    public function host(string $host = null) : ApiRequest
    {
        $this->host = $host;
        return $this;
    }

    /**
     * Set the request method to GET.
     *
     * @param string $uri
     * @return ApiRequest $this
     */
    public function get(string $uri) : ApiRequest
    {
        $this->method = 'GET';
        $this->path = $uri;
        return $this;
    }

    /**
     * Set the request method to POST.
     *
     * @param string $uri
     * @return ApiRequest $this
     */
    public function post(string $uri) : ApiRequest
    {
        $this->method = 'POST';
        $this->path = $uri;
        return $this;
    }

    /**
     * Append a parameter to the uri of the request.
     *
     * @param string $key
     * @param $value
     * @return ApiRequest $this
     */
    public function parameter(string $key, $value) : ApiRequest
    {
        if($value !== null)
            $this->parameters[$key] = $value;
        return $this;
    }

    /**
     * Append a parameter to the uri of the request.
     *
     * @param string $key
     * @param $value
     * @return ApiRequest $this
     */
    public function header(string $key, $value) : ApiRequest
    {
        if($value !== null)
            $this->headers[$key] = $value;
        return $this;
    }

    /**
     * Set form data to the request.
     *
     * @param array $data
     * @return ApiRequest $this
     */
    public function data(array $data) : ApiRequest
    {
        $this->data += $data;
        return $this;
    }

    /**
     * @param int $minutes
     * @return ApiRequest $this
     */
    public function cache(int $minutes) : ApiRequest
    {
        $this->cache = $minutes;
        return $this;
    }

    /**
     * @return ApiRequest $this
     */
    public function force() : ApiRequest
    {
        $this->force = true;
        return $this;
    }

    /**
     * @return string
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @return int
     */
    public function getCacheTTL(): int
    {
        return $this->cache;
    }

    /**
     * @return boolean
     */
    public function isForced(): bool
    {
        return $this->force;
    }
}