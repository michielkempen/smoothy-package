<?php

namespace Smoothy\Api\Responses\Transformers\Custom\Items;

use Smoothy\Api\Responses\Models\Custom\Items\Item;
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