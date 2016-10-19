<?php

namespace Smoothy\Api\Custom;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Smoothy\Api\Custom\Models\Module;
use Smoothy\Api\Custom\Models\Item;
use Smoothy\Api\SmoothyApi;
use Smoothy\Foundation\Api\ApiException;
use Smoothy\Foundation\Api\ApiResponse;

class CustomApi
{
    private $api;
    private $transformer;

    public function __construct(SmoothyApi $api)
    {
        $this->api = $api;
        $this->transformer = new CustomApiTransformer;
    }

    /**
     * Get the modules with the given ids.
     *
     * uri:         custom/get
     * parameter:   module_ids      array       required
     *
     * @param array $moduleIds
     * @return Collection
     * @throws ApiException
     */
    public function getModules(
        array $moduleIds
    ) {
        $request = $this->api->newRequest()
            ->get('custom/get')
            ->parameter('module_ids', $moduleIds);

        $response = $this->api->call($request);

        if($response->isSuccessFull())
            return $this->transformer->transformGetModulesResponse($response);

        throw new ApiException($response);
    }

    /**
     * Get the types of the given module.
     *
     * uri:         custom/types/all
     * parameter:   module_id       int         required
     *
     * @param int $moduleId
     * @return Collection
     * @throws ApiException
     */
    public function getAllTypes(
        int $moduleId
    ) {
        $request = $this->api->newRequest()
            ->get('custom/types/all')
            ->parameter('module_id', $moduleId);

        $response = $this->api->call($request);

        if($response->isSuccessFull())
            return $this->transformer->transformGetAllTypesResponse($response);

        throw new ApiException($response);
    }

    /**
     * Get the types with the given ids.
     *
     * uri:         custom/types/get
     * parameter:   type_ids        array       required
     *
     * @param array $typeIds
     * @return Collection
     * @throws ApiException
     */
    public function getTypes(
        array $typeIds
    ) {
        $request = $this->api->newRequest()
            ->get('custom/types/get')
            ->parameter('type_ids', $typeIds);

        $response = $this->api->call($request);

        if($response->isSuccessFull())
            return $this->transformer->transformGetTypesResponse($response);

        throw new ApiException($response);
    }

    /**
     * ...
     *
     * uri:         custom/items/all
     * parameter:   module_id       int         required
     * parameter:   parent_item_id  int         required
     * parameter:   per_page        int
     * parameter:   page            int
     *
     * @param int $moduleId
     * @param int $parentItemId
     * @param int|null $perPage
     * @param int|null $page
     * @return Collection
     * @throws ApiException
     */
    public function getAllItems(
        int $moduleId,
        int $parentItemId,
        int $perPage = null,
        int $page = null
    ) {
        $request = $this->api->newRequest()
            ->get('custom/items/all')
            ->parameter('module_id', $moduleId)
            ->parameter('parent_item_id', $parentItemId)
            ->parameter('per_page', $perPage)
            ->parameter('page', $page);

        $response = $this->api->call($request);

        if($response->isSuccessFull())
            return $this->transformer->transformGetAllItemsResponse($response);

        throw new ApiException($response);
    }

    /**
     * ...
     *
     * uri:         custom/items/get
     * parameter:   item_id         int         required
     *
     * @param int $itemId
     * @return Item
     * @throws ApiException
     */
    public function getItem(
        int $itemId
    ) {
        $request = $this->api->newRequest()
            ->get('custom/items/get')
            ->parameter('item_ids', [$itemId]);

        $response = $this->api->call($request);

        if($response->isSuccessFull())
            return $this->transformer->transformGetItemsResponse($response)->first();

        throw new ApiException($response);
    }

    /**
     * ...
     *
     * uri:         custom/items/get
     * parameter:   item_ids        array       required
     * parameter:   per_page        int
     * parameter:   page            int
     *
     * @param array $itemIds
     * @param int|null $perPage
     * @param int|null $page
     * @return Collection
     * @throws ApiException
     */
    public function getItems(
        array $itemIds,
        int $perPage = null,
        int $page = null
    ) {
        $request = $this->api->newRequest()
            ->get('custom/items/get')
            ->parameter('item_ids', $itemIds)
            ->parameter('per_page', $perPage)
            ->parameter('page', $page);

        $response = $this->api->call($request);

        if($response->isSuccessFull())
            return $this->transformer->transformGetItemsResponse($response);

        throw new ApiException($response);
    }

    public function getItemsWhere() {
        // TODO
    }

    /**
     * ...
     *
     * uri:         custom/items/create
     * parameter:   module_id       int         required
     * parameter:   parent_item_id  int         required
     * parameter:   type_id         int         required
     *
     * @param int $moduleId
     * @param int $parentItemId
     * @param int $typeId
     * @param array $formData
     * @return ApiResponse
     * @throws ApiException
     */
    public function createItem(
        int $moduleId,
        int $parentItemId,
        int $typeId,
        array $formData
    ) {
        $request = $this->api->newRequest()
            ->post('custom/items/create')
            ->parameter('module_id', $moduleId)
            ->parameter('parent_item_id', $parentItemId)
            ->parameter('type_id', $typeId)
            ->data($formData);

        $response = $this->api->call($request);

        if($response->isSuccessFull() || $response->containsValidationErrors())
            return $response;

        throw new ApiException($response);
    }

    /**
     * ...
     *
     * uri:         custom/items/update
     * parameter:   item_id         int         required
     *
     * @param int $itemId
     * @param array $formData
     * @return ApiResponse
     * @throws ApiException
     */
    public function updateItem(
        int $itemId,
        array $formData
    ) {
        $request = $this->api->newRequest()
            ->post('custom/items/update')
            ->parameter('item_id', $itemId)
            ->data($formData);

        $response = $this->api->call($request);

        if($response->isSuccessFull() || $response->containsValidationErrors())
            return $response;

        throw new ApiException($response);
    }

    /**
     * ...
     *
     * uri:         custom/items/delete
     * parameter:   item_ids        array       required
     *
     * @param array $itemIds
     * @return ApiResponse
     * @throws ApiException
     */
    public function deleteItem(
        array $itemIds
    ) {
        $request = $this->api->newRequest()
            ->post('custom/items/delete')
            ->parameter('item_ids', $itemIds);

        $response = $this->api->call($request);

        if($response->isSuccessFull() || $response->containsValidationErrors())
            return $response;

        throw new ApiException($response);
    }

    /**
     * ...
     *
     * uri:         custom/items/search
     * parameter:   query           string      required
     * parameter:   modules         array       required
     * parameter:   per_page        int
     * parameter:   page            int
     *
     * @param string $query
     * @param Collection $searchIndex
     * @param int|null $perPage
     * @param int|null $page
     * @return Collection
     * @throws ApiException
     */
    public function searchItems(
        string $query,
        Collection $searchIndex,
        int $perPage = null,
        int $page = null
    ) {
        $modules = $searchIndex->map(function($item) {
            return collect($item)->only(['module_id', 'parent_item_id'])->toArray();
        })->toJson();

        $request = $this->api->newRequest()
            ->get('custom/items/search')
            ->parameter('query', $query)
            ->parameter('modules', $modules)
            ->parameter('per_page', $perPage)
            ->parameter('page', $page);

        $response = $this->api->call($request);

        if($response->isSuccessFull())
            return $this->transformer->transformSearchItemsResponse($response, $searchIndex);

        throw new ApiException($response);
    }
}