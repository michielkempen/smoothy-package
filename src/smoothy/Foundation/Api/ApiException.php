<?php

namespace Smoothy\Foundation\Api;

class ApiException extends \Exception
{
    public function __construct(ApiResponse $response)
    {
        parent::__construct(
            $response->getContent()['message'],
            $response->getStatusCode()
        );
    }
}