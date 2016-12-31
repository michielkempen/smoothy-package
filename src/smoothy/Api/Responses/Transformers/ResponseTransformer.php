<?php

namespace Smoothy\Api\Responses\Transformers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Smoothy\Api\Responses\SmoothyApiResponse;

abstract class ResponseTransformer
{
    /**
     * @param SmoothyApiResponse $response
     * @return mixed
     */
    public abstract function transform(SmoothyApiResponse $response);

    /**
     * @param SmoothyApiResponse $response
     * @param \Closure $map
     * @return mixed
     */
    protected function item(SmoothyApiResponse $response, \Closure $map)
    {
        return call_user_func($map, $response->getContent()['data']);
    }

    /**
     * @param SmoothyApiResponse $response
     * @param \Closure $map
     * @return Collection
     */
    protected function collection(SmoothyApiResponse $response, \Closure $map)
    {
        return collect($response->getContent()['data'])->map($map);
    }

    /**
     * @param SmoothyApiResponse $response
     * @param \Closure $map
     * @return LengthAwarePaginator|Collection
     */
    protected function possiblyPaginatedCollection(SmoothyApiResponse $response, \Closure $map)
    {
        $collection = $this->collection($response, $map);

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