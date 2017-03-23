<?php

namespace Smoothy\Api\Responses\Transformers\Content\Items;

use Smoothy\Api\Responses\Models\Content\Items\Item;
use Smoothy\Api\Responses\Transformers\ResponseTransformer;
use Smoothy\Api\Responses\SmoothyApiResponse;

class GetTransformer extends ResponseTransformer
{
    /**
     * @param SmoothyApiResponse $response
     * @return Item
     */
    public function transform(SmoothyApiResponse $response)
    {
        return $this->item($response, function($item) {
            return (new ItemTransformer)->transform($item);
        });
    }
}