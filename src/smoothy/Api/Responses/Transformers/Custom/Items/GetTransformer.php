<?php

namespace Smoothy\Api\Responses\Transformers\Custom\Items;

use Smoothy\Api\Responses\Models\Custom\Items\Item;
use Smoothy\Api\Responses\Transformers\Transformer;
use Smoothy\Api\Responses\SmoothyApiResponse;

class GetTransformer extends Transformer
{
    /**
     * @param SmoothyApiResponse $response
     * @return Item
     */
    public function transform(SmoothyApiResponse $response)
    {
        return $this->item($response, function($item) {
            return Item::create($item);
        });
    }
}