<?php

namespace Smoothy\Api\Custom;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Smoothy\Api\Custom\Models\Module;
use Smoothy\Api\Custom\Models\Page;
use Smoothy\Foundation\Api\ApiResponse;

class CustomApiTransformer
{
    /**
     * @param ApiResponse $response
     * @return Collection
     */
	public static function transformGetPagesResponse(ApiResponse $response) : Collection
	{
	    return collect($response->getContent()['data'])->map(function($item) {
            return Page::create($item);
        });
	}

    /**
     * @param ApiResponse $response
     * @return Page
     */
	public static function transformGetPageResponse(ApiResponse $response) : Page
	{
        return Page::create(
            $response->getContent()['data']
        );
	}

    /**
     * @param ApiResponse $response
     * @return Module
     */
	public static function transformGetModuleResponse(ApiResponse $response)
	{
		return Module::create(
            $response->getContent()['data']
        );
	}

    /**
     * @param ApiResponse $response
     * @param Collection $searchIndex
     * @return LengthAwarePaginator|Collection
     */
    public static function transformSearchResponse(ApiResponse $response, Collection $searchIndex)
    {
        $data = collect($response->getContent()['data'])
            ->map(function($item){
                return Page::create($item);
            })->map(function(Page $page) use ($searchIndex) {
                $searchItem = $searchIndex
                    ->where('module_id', $page->getCustomId())
                    ->where('parent_id', $page->getParentId())
                    ->first();

                return is_null($searchItem)
                    ? null
                    : call_user_func($searchItem['callback'], $page);
            });

        if(isset($response->getContent()['meta']['pagination']))
        {
            $pagination = $response->getContent()['meta']['pagination'];

            return new LengthAwarePaginator(
                $data,
                $pagination['total'],
                $pagination['per_page'],
                $pagination['current_page']
            );
        }

        return $data;
    }

	public static function transformAddPageResponse(ApiResponse $response)
	{
	    return null;
	}
}