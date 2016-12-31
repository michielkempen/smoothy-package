<?php

namespace Smoothy\Api\Responses\Transformers\Website;

use Smoothy\Api\Responses\Models\Website\Website;
use Smoothy\Api\Responses\Transformers\ResponseTransformer;
use Smoothy\Api\Responses\SmoothyApiResponse;

class GetTransformer extends ResponseTransformer
{
    /**
     * @param SmoothyApiResponse $response
     * @return Website
     */
    public function transform(SmoothyApiResponse $response)
    {
        return $this->item($response, function($data) {
            return Website::create($data);
        });
    }
}