<?php

namespace Smoothy\Api\Requests;

use GuzzleHttp\Psr7\Request;

class RequestParser
{
    /**
     * @param ApiRequest $request
     * @return Request
     */
    public function parse(ApiRequest $request) : Request
    {
        return new Request(
            $request->getMethod(),
            $this->buildUrl($request),
            $request->getHeaders()
        );
    }

    /**
     * Append the parameters to the uri.
     *
     * @param ApiRequest $request
     * @return string
     */
    private function buildUrl(ApiRequest $request)
    {
        $parameters = $request->getParameters();
        ksort($parameters);

        return http_build_url([
            'scheme' => $request->getScheme(),
            'host' => $request->getHost(),
            'path' => $request->getPath(),
            'query' => http_build_query($parameters)
        ]);
    }
}