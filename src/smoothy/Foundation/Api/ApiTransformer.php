<?php

namespace Smoothy\Foundation\Api;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class ApiTransformer
{
    /**
     * @param ApiResponse $response
     * @param \Closure $map
     * @return Collection
     */
    protected function transformCollection(ApiResponse $response, \Closure $map)
    {
        return collect($response->getContent()['data'])->map($map);
    }

    /**
     * @param ApiResponse $response
     * @param \Closure $map
     * @return LengthAwarePaginator|Collection
     */
    protected function transformPossiblyPaginatedCollection(ApiResponse $response, \Closure $map)
    {
        $collection = $this->transformCollection($response, $map);

        if(isset($response->getContent()['meta']['pagination']))
        {
            $pagination = $response->getContent()['meta']['pagination'];

            return new LengthAwarePaginator(
                $collection,
                $pagination['total'],
                $pagination['per_page'],
                $pagination['current_page']
            );
        }

        return $collection;
    }
}