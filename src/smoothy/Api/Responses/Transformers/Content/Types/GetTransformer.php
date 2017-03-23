<?php

namespace Smoothy\Api\Responses\Transformers\Content\Types;

use Smoothy\Api\Responses\Models\Content\Types\Type;
use Smoothy\Api\Responses\Transformers\ResponseTransformer;
use Smoothy\Api\Responses\SmoothyApiResponse;

class GetTransformer extends ResponseTransformer
{
    /**
     * @param SmoothyApiResponse $response
     * @return Type
     */
    public function transform(SmoothyApiResponse $response)
    {
        return $this->item($response, function($item) {
            return (new TypeTransformer)->transform($item);
        });
    }
}