<?php

namespace Smoothy\Api\Wrapper\Content\Items;

use Illuminate\Support\Collection;
use Smoothy\Api\Requests\SmoothyApiRequest;
use Smoothy\Api\Responses\Transformers\Content\Items\AllTransformer;
use Smoothy\Api\Responses\Transformers\Content\Items\GetTransformer;
use Smoothy\Api\Responses\Transformers\Content\Items\SearchTransformer;

class ItemsApi
{
    /**
     * @param int $moduleId
     * @param int $parentItemId
     * @param string $language
     * @param int|null $perPage
     * @param int|null $page
     * @return SmoothyApiRequest
     */
    public function all(int $moduleId, int $parentItemId = 0, string $language = null, int $perPage = null, int $page = null)
    {
        return (new SmoothyApiRequest)
            ->get('content/'.$moduleId.'/'.$parentItemId.'/items')
            ->parameter('language', $language)
            ->parameter('per_page', $perPage)
            ->parameter('page', $page)
            ->transform(new AllTransformer);
    }

    /**
     * @param int $moduleId
     * @param int $parentItemId
     * @param int $itemId
     * @return SmoothyApiRequest
     */
    public function get(int $moduleId, int $parentItemId, int $itemId)
    {
        return (new SmoothyApiRequest)
            ->get('content/'.$moduleId.'/'.$parentItemId.'/items/'.$itemId)
            ->transform(new GetTransformer);
    }

    /**
     * @param int $moduleId
     * @param int $parentItemId
     * @param int $typeId
     * @param string $language
     * @param array $formData
     * @return SmoothyApiRequest
     */
    public function create(int $moduleId, int $parentItemId, int $typeId, string $language, array $formData)
    {
        return (new SmoothyApiRequest)
            ->post('content/'.$moduleId.'/'.$parentItemId.'/items')
            ->parameter('type_id', $typeId)
            ->parameter('language', $language)
            ->data($formData);
    }

    /**
     * @param string $query
     * @param Collection $searchIndex
     * @param string $language
     * @param int|null $perPage
     * @param int|null $page
     * @return SmoothyApiRequest
     */
    public function search(string $query, Collection $searchIndex, string $language = null, int $perPage = null, int $page = null)
    {
        $modules = $searchIndex->map(function($item) {
            return collect($item)->only(['module_id', 'parent_item_id'])->toArray();
        })->toJson();

        return (new SmoothyApiRequest)
            ->get('content/items/search')
            ->parameter('query', $query)
            ->parameter('modules', $modules)
            ->parameter('language', $language)
            ->parameter('per_page', $perPage)
            ->parameter('page', $page)
            ->transform(new SearchTransformer($searchIndex));
    }
}