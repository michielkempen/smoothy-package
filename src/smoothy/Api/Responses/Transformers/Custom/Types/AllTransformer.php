<?php

namespace Smoothy\Api\Responses\Transformers\Custom\Types;

use Illuminate\Support\Collection;
use Smoothy\Api\Responses\Models\Custom\Types\Type;
use Smoothy\Api\Responses\Transformers\Transformer;
use Smoothy\Api\Responses\SmoothyApiResponse;

class AllTransformer extends Transformer
{
    /**
     * @param SmoothyApiResponse $response
     * @return Collection
     */
    public function transform(SmoothyApiResponse $response)
    {
        return $this->collection($response, function($item) {
            return Type::create($item);
        });
    }
}