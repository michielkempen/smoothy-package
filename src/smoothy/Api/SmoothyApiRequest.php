<?php

namespace Smoothy\Api;

use Smoothy\Foundation\Api\ApiRequest;

class SmoothyApiRequest extends ApiRequest
{
    public function __construct()
    {
        $this
            ->scheme(smoothy_config('api-scheme'))
            ->host(smoothy_config('api-host'))
            ->header('Accept', 'application/vnd.smoothy.v1+json')
            ->header('Authorization', 'Bearer '.smoothy_config('api-access-token', cache()->get('api-access-token')))
            ->cache(10)
            ->force();
    }
}