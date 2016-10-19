<?php

namespace Smoothy\Api\Custom;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Smoothy\Api\Custom\Models\Module;
use Smoothy\Api\Custom\Models\Item;
use Smoothy\Api\Custom\Models\Type;
use Smoothy\Foundation\Api\ApiResponse;
use Smoothy\Foundation\Api\ApiTransformer;

class CustomApiTransformer extends ApiTransformer
{
    /**
     * @param ApiResponse $response
     * @return Collection
     */
    public function transformGetModulesResponse(ApiResponse $response)
    {
        return $this->transformCollection($response, function($item) {
            return Module::create($item);
        });
    }

    /**
     * @param ApiResponse $response
     * @return Collection
     */
    public function transformGetAllTypesResponse(ApiResponse $response)
    {
        return $this->transformCollection($response, function($item) {
            return Type::create($item);
        });
    }

    /**
     * @param ApiResponse $response
     * @return Collection
     */
    public function transformGetTypesResponse(ApiResponse $response)
    {
        return $this->transformCollection($response, function($item) {
            return Type::create($item);
        });
    }

    /**
     * @param ApiResponse $response
     * @return LengthAwarePaginator|Collection
     */
    public function transformGetAllItemsResponse(ApiResponse $response)
    {
        return $this->transformPossiblyPaginatedCollection($response, function($item) {
            return Item::create($item);
        });
    }

    /**
     * @param ApiResponse $response
     * @return LengthAwarePaginator|Collection
     */
    public function transformGetItemsResponse(ApiResponse $response)
    {
        return $this->transformPossiblyPaginatedCollection($response, function($item) {
            return Item::create($item);
        });
    }

    /**
     * @param ApiResponse $response
     * @param Collection $searchIndex
     * @return LengthAwarePaginator|Collection
     */
    public function transformSearchItemsResponse(ApiResponse $response, Collection $searchIndex)
    {
        return $this->transformPossiblyPaginatedCollection($response, function($item) use ($searchIndex) {
            $item = Item::create($item);

            $searchItem = $searchIndex
                ->where('module_id', $item->getTypeId())
                ->where('parent_id', $item->getParentItemId())
                ->first();

            return is_null($searchItem)
                ? null
                : call_user_func($searchItem['callback'], $item);
        });
    }
}