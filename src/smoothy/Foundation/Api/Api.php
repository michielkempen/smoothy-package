<?php

namespace Smoothy\Foundation\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\UploadedFile;
use Smoothy\Foundation\Cache\ResponseCache;

abstract class Api
{
    /**
     * @var ApiRequest
     */
    private $apiRequest;

    /**
     * @var ResponseCache
     */
    private $cache;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Response
     */
    private $response;

    /**
     * Api constructor.
     */
    public function __construct()
    {
        $this->cache = app(ResponseCache::class);
    }

    /**
     * @param ApiRequest $apiRequest
     * @return ApiResponse
     * @throws \Exception
     */
    public function call(ApiRequest $apiRequest) : ApiResponse
    {
        $this->apiRequest = $apiRequest;

        if($this->apiRequest->getMethod() == '')
            throw new \Exception('No method set.');

        return $this
            ->buildRequest()
            ->fetchResponse()
            ->parseResponse();
    }

    /**
     * @return Api
     */
    private function buildRequest()
    {
        $this->request = new Request(
            $this->apiRequest->getMethod(),
            $this->buildUrl(),
            $this->apiRequest->getHeaders()
        );

        return $this;
    }

    /**
     * Append the parameters to the uri.
     *
     * @return string
     */
    private function buildUrl()
    {
        $parameters = $this->apiRequest->getParameters();
        ksort($parameters);

        return http_build_url([
            'scheme' => $this->apiRequest->getScheme(),
            'host' => $this->apiRequest->getHost(),
            'path' => $this->apiRequest->getPath(),
            'query' => http_build_query($parameters)
        ]);
    }

    /**
     * Send the request.
     *
     * @return $this
     */
    private function fetchResponse()
    {
        // if the request is cacheable and not forced to be sent
        if(!$this->apiRequest->isForced() && $this->cache->isCacheable($this->request))
        {
            // try to get the response from the cache
            $this->response = $this->cache->getCachedResponseFor($this->request);

            // if the response is fetched from the cache
            if($this->response != null)
                return $this;
        }

        // fetch new response
        $this->response = $this->sendRequest();

        // cache the response for the provided time
        if($this->apiRequest->getCacheTTL() > 0)
        {
            $this->cache->cacheResponse($this->request, $this->response, $this->apiRequest->getCacheTTL());
            $this->response = $this->cache->getCachedResponseFor($this->request);
        }

        return $this;
    }

    /**
     * @return Response
     */
    private function sendRequest() : Response
    {
        return app(Client::class)->send(
            $this->request,
            $this->buildRequestOptions()
        );
    }

    /**
     * @return array
     */
    private function buildRequestOptions()
    {
        $options = [
            'http_errors' => false
        ];

        if(!empty($this->apiRequest->getData()))
        {
            $options['multipart'] = array();
            foreach ($this->apiRequest->getData() as $name => $value)
            {
                $fields = array();
                $fields['name'] = $name;

                if(is_array($value)) {
                    $fields['contents'] = json_encode($value);
                }
                elseif($value instanceof UploadedFile) {
                    $fields['contents'] = fopen($value->getRealPath(), 'r');
                    $fields['filename'] = $value->getClientOriginalName();
                }
                else {
                    $fields['contents'] = $value;
                }

                array_push($options['multipart'], $fields);
            }
        }

        return $options;
    }

    /**
     * Parse the given response.
     *
     * @return ApiResponse
     */
    protected function parseResponse() : ApiResponse
    {
        return new ApiResponse(
            json_decode($this->response->getBody()->getContents(), true),
            $this->response->getStatusCode()
        );
    }
}