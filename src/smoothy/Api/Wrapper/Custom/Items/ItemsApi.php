<?php

namespace Smoothy\Api\Wrapper\Custom\Items;

use Illuminate\Support\Collection;
use Smoothy\Api\Requests\SmoothyApiRequest;
use Smoothy\Api\Responses\Transformers\Custom\Items\AllTransformer;
use Smoothy\Api\Responses\Transformers\Custom\Items\GetTransformer;
use Smoothy\Api\Responses\Transformers\Custom\Items\SearchTransformer;

class ItemsApi
{
    /**
     * @param int $moduleId
     * @param int $parentItemId
     * @param int|null $perPage
     * @param int|null $page
     * @return SmoothyApiRequest
     */
    public function all(int $moduleId, int $parentItemId = null, int $perPage = null, int $page = null)
    {
        return (new SmoothyApiRequest)
            ->get('custom/'.$moduleId.'/items')
            ->parameter('parent_item_id', $parentItemId)
            ->parameter('per_page', $perPage)
            ->parameter('page', $page)
            ->transform(new AllTransformer);
    }

    /**
     * @param int $moduleId
     * @param int $itemId
     * @return SmoothyApiRequest
     */
    public function get(int $moduleId, int $itemId)
    {
        return (new SmoothyApiRequest)
            ->get('custom/'.$moduleId.'/items/'.$itemId)
            ->transform(new GetTransformer);
    }

    /**
     * @param int $moduleId
     * @param int $parentItemId
     * @param int $typeId
     * @param array $formData
     * @return SmoothyApiRequest
     */
    public function create(int $moduleId, int $parentItemId = null, int $typeId, array $formData)
    {
        return (new SmoothyApiRequest)
            ->post('custom/'.$moduleId.'/items')
            ->parameter('parent_item_id', $parentItemId)
            ->parameter('type_id', $typeId)
            ->data($formData);
    }

    /**
     * @param int $moduleId
     * @param int $itemId
     * @param array $formData
     * @return SmoothyApiRequest
     */
    public function update(int $moduleId, int $itemId, array $formData)
    {
        return (new SmoothyApiRequest)
            ->post('custom/'.$moduleId.'/items/'.$itemId)
            ->data($formData);
    }

    /**
     * @param int $moduleId
     * @param int $itemId
     * @return SmoothyApiRequest
     */
    public function delete(int $moduleId, int $itemId)
    {
        return (new SmoothyApiRequest)
            ->delete('custom/'.$moduleId.'/items/'.$itemId);
    }

    /**
     * @param string $query
     * @param Collection $searchIndex
     * @param int|null $perPage
     * @param int|null $page
     * @return SmoothyApiRequest
     */
    public function search(string $query, Collection $searchIndex, int $perPage = null, int $page = null)
    {
        $modules = $searchIndex->map(function($item) {
            return collect($item)->only(['module_id', 'parent_item_id'])->toArray();
        })->toJson();

        return (new SmoothyApiRequest)
            ->get('custom/items/search')
            ->parameter('query', $query)
            ->parameter('modules', $modules)
            ->parameter('per_page', $perPage)
            ->parameter('page', $page)
            ->transform(new SearchTransformer($searchIndex));
    }
}