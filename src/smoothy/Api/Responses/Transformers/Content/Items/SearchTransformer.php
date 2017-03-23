<?php

namespace Smoothy\Api\Responses\Transformers\Content\Items;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Smoothy\Api\Responses\Transformers\ResponseTransformer;
use Smoothy\Api\Responses\SmoothyApiResponse;

class SearchTransformer extends ResponseTransformer
{
    /**
     * @var Collection
     */
    private $searchIndex;

    /**
     * SearchTransformer constructor.
     *
     * @param Collection $searchIndex
     */
    public function __construct(Collection $searchIndex)
    {
        $this->searchIndex = $searchIndex;
    }

    /**
     * @param SmoothyApiResponse $response
     * @return LengthAwarePaginator|Collection
     */
    public function transform(SmoothyApiResponse $response)
    {
        return $this->possiblyPaginatedCollection($response, function($item) {
            $item = (new ItemTransformer)->transform($item);;

            $searchItem = $this->searchIndex
                ->where('module_id', $item->getModuleId())
                ->where('parent_item_id', $item->getParentItemId())
                ->first();

            return is_null($searchItem)
                ? null
                : call_user_func($searchItem['callback'], $item);
        });
    }
}