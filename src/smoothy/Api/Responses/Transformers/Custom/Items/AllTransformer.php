<?php

namespace Smoothy\Api\Responses\Transformers\Custom\Items;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Smoothy\Api\Responses\Models\Custom\Items\Item;
use Smoothy\Api\Responses\Transformers\Transformer;
use Smoothy\Api\Responses\SmoothyApiResponse;

class AllTransformer extends Transformer
{
    /**
     * @param SmoothyApiResponse $response
     * @return LengthAwarePaginator|Collection
     */
    public function transform(SmoothyApiResponse $response)
    {
        return $this->possiblyPaginatedCollection($response, function($item) {
            return Item::create($item);
        });
    }
}