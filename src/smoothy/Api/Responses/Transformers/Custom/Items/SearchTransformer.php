<?php

namespace Smoothy\Api\Responses\Transformers\Custom\Items;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Smoothy\Api\Responses\Models\Custom\Items\Item;
use Smoothy\Api\Responses\Transformers\Transformer;
use Smoothy\Api\Responses\SmoothyApiResponse;

class SearchTransformer extends Transformer
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
            $item = Item::create($item);

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