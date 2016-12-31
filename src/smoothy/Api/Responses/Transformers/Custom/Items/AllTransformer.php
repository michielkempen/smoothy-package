<?php

namespace Smoothy\Api\Responses\Transformers\Custom\Items;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Smoothy\Api\Responses\Transformers\ResponseTransformer;
use Smoothy\Api\Responses\SmoothyApiResponse;

class AllTransformer extends ResponseTransformer
{
    /**
     * @param SmoothyApiResponse $response
     * @return LengthAwarePaginator|Collection
     */
    public function transform(SmoothyApiResponse $response)
    {
        return $this->possiblyPaginatedCollection($response, function($item) {
            return (new ItemTransformer)->transform($item);
        });
    }
}