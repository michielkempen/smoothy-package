<?php

namespace Smoothy\Api;

use Smoothy\Foundation\Api\ApiRequest;

class SmoothyApiRequest extends ApiRequest
{
    public function __construct()
    {
        $scheme = env('SMOOTHY_API_SCHEME');
        $host = env('SMOOTHY_API_HOST');
        $accessToken = env('SMOOTHY_API_ACCESS_TOKEN', cache()->get('api-access-token'));

        $this
            ->scheme($scheme)
            ->host($host)
            ->header('Accept', 'application/vnd.smoothy.v1+json')
            ->header('Authorization', 'Bearer '.$accessToken)
            ->cache(10)
            ->force();
    }
}