<?php

namespace Smoothy\Api\Responses\Transformers\Website;

use Smoothy\Api\Responses\Models\Website\Website;
use Smoothy\Api\Responses\Transformers\Transformer;
use Smoothy\Api\Responses\SmoothyApiResponse;

class GetTransformer extends Transformer
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