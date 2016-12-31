<?php

namespace Smoothy\Api\Responses\Transformers\Custom\Types;

use Smoothy\Api\Responses\Models\Custom\Types\Type;
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