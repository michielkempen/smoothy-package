<?php

namespace Smoothy\Api\Exceptions;

use Smoothy\Api\Responses\SmoothyApiResponse;

class ResponseException extends \Exception
{
    public function __construct(SmoothyApiResponse $response)
    {
        parent::__construct(
            $response->getContent()['message'],
            $response->getStatusCode()
        );
    }
}