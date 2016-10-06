<?php

namespace Smoothy\Foundation\Cache;

use GuzzleHttp\Psr7\Response;

class ResponseSerializer
{
    /**
     * Serialize response.
     *
     * @param Response $response
     * @return string
     */
    public function serialize(Response $response)
    {
        return \GuzzleHttp\Psr7\str($response);
    }

    /**
     * UnSerialize response.
     *
     * @param $serializedResponse
     * @return Response
     */
    public function unserialize($serializedResponse)
    {
        return \GuzzleHttp\Psr7\parse_response($serializedResponse);
    }
}