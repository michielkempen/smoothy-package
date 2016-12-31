<?php

namespace Smoothy\Api\Responses\Transformers\Custom\Types;

use Illuminate\Support\Collection;
use Smoothy\Api\Responses\Transformers\ResponseTransformer;
use Smoothy\Api\Responses\SmoothyApiResponse;

class AllTransformer extends ResponseTransformer
{
    /**
     * @param SmoothyApiResponse $response
     * @return Collection
     */
    public function transform(SmoothyApiResponse $response)
    {
        return $this->collection($response, function($item) {
            return (new TypeTransformer)->transform($item);
        });
    }
}