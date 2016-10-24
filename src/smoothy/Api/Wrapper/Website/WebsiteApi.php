<?php

namespace Smoothy\Api\Wrapper\Website;

use Smoothy\Api\Requests\SmoothyApiRequest;
use Smoothy\Api\Responses\Transformers\Website\GetTransformer;

class WebsiteApi
{
    /**
     * Get the status of a website module.
     *
     * @param int $moduleId
     * @return SmoothyApiRequest
     */
    public function get(int $moduleId)
    {
        return (new SmoothyApiRequest)
            ->get('website/'.$moduleId)
            ->transform(new GetTransformer);
    }
}