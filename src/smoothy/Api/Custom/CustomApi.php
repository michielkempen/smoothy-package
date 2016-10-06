<?php

namespace Smoothy\Api\Custom;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Smoothy\Api\Custom\Models\Module;
use Smoothy\Api\Custom\Models\Page;
use Smoothy\Api\SmoothyApi;
use Smoothy\Foundation\Api\ApiException;
use Smoothy\Foundation\Api\ApiResponse;

class CustomApi
{
    private $api;

    public function __construct(SmoothyApi $api)
    {
        $this->api = $api;
    }

    /**
     * Get the pages from a custom module.
     *
     * @param int $moduleId
     * @param int $parentId
     * @param string $language
     * @param int|null $perPage
     * @param int|null $page
     * @return Collection
     * @throws ApiException
     */
    public function getPages(
        int $moduleId,
        int $parentId,
        string $language,
        int $perPage = null,
        int $page = null
    )
    {
        $request = $this->api->newRequest()
            ->get('custom/pages')
            ->parameter('module_id', $moduleId)
            ->parameter('parent_id', $parentId)
            ->parameter('language', $language)
            ->parameter('per_page', $perPage)
            ->parameter('page', $page);

        $response = $this->api->call($request);

        if($response->isSuccessFull())
            return CustomApiTransformer::transformGetPagesResponse($response);

        throw new ApiException($response);
    }

    /**
     * Get a page from a custom module.
     *
     * @param int $pageId
     * @param string $language
     * @return Page
     * @throws ApiException
     */
    public function getPage(
        int $pageId,
        string $language
    )
    {
        $request = $this->api->newRequest()
            ->get('custom/page')
            ->parameter('page_id', $pageId)
            ->parameter('language', $language);

        $response = $this->api->call($request);

        if($response->isSuccessFull())
            return CustomApiTransformer::transformGetPageResponse($response);

        throw new ApiException($response);
    }

    /**
     * Get the fields of a custom module.
     *
     * @param int $moduleId
     * @return Module
     * @throws ApiException
     */
    public function get(
        int $moduleId
    )
    {
        $request = $this->api->newRequest()
            ->get('custom')
            ->parameter('module_id', $moduleId);

        $response = $this->api->call($request);

        if($response->isSuccessFull())
            return CustomApiTransformer::transformGetModuleResponse($response);

        throw new ApiException($response);
    }

    /**
     * @param string $query
     * @param Collection $searchIndex
     * @param string $language
     * @param int|null $perPage
     * @param int|null $page
     * @return LengthAwarePaginator|Collection
     * @throws ApiException
     */
    public function search(
        string $query,
        Collection $searchIndex,
        string $language,
        int $perPage = null,
        int $page = null
    )
    {
        $request = $this->api->newRequest()
            ->get('custom/search')
            ->parameter('query', $query)
            ->parameter('modules', $this->getModulesFromSearchIndex($searchIndex))
            ->parameter('language', $language)
            ->parameter('per_page', $perPage)
            ->parameter('page', $page);

        $response = $this->api->call($request);

        if($response->isSuccessFull())
            return CustomApiTransformer::transformSearchResponse(
                $response,
                $searchIndex
            );

        throw new ApiException($response);
    }

    /**
     * Add a page to a custom module.
     *
     * @param int $moduleId
     * @param int $parentId
     * @param string $language
     * @param array $formData
     * @return ApiResponse
     * @throws ApiException
     */
    public function addPage(
        int $moduleId,
        int $parentId,
        string $language,
        array $formData
    )
    {
        $request = $this->api->newRequest()
            ->post('custom/pages/create')
            ->data($formData)
            ->parameter('language', $language)
            ->parameter('module_id', $moduleId)
            ->parameter('parent_id', $parentId);

        $response = $this->api->call($request);

        if($response->isSuccessFull() || $response->containsValidationErrors())
            return $response;

        throw new ApiException($response);
    }

    /**
     * @param Collection $searchIndex
     * @return string
     */
    private function getModulesFromSearchIndex(Collection $searchIndex)
    {
        return $searchIndex->map(function($item) {
            return collect($item)
                ->only(['module_id', 'parent_id'])
                ->toArray();
        })->toJson();
    }
}