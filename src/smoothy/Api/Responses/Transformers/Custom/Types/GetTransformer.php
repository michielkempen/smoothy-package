<?php

namespace Smoothy\Api\Responses\Transformers\Custom\Types;

use Smoothy\Api\Responses\Models\Custom\Types\Type;
use Smoothy\Api\Responses\Transformers\Transformer;
use Smoothy\Api\Responses\SmoothyApiResponse;

class GetTransformer extends Transformer
{
    /**
     * @param SmoothyApiResponse $response
     * @return Type
     */
    public function transform(SmoothyApiResponse $response)
    {
        return $this->item($response, function($item) {
            return Type::create($item);
        });
    }
}