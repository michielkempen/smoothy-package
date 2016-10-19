<?php

namespace Smoothy\Api\Website;

use Smoothy\Api\SmoothyApi;
use Smoothy\Api\Website\Models\Website;
use Smoothy\Foundation\Api\ApiException;

class WebsiteApi
{
    private $api;

    public function __construct(SmoothyApi $api)
    {
        $this->api = $api;
        $this->transformer = new WebsiteApiTransformer;
    }

    /**
     * Get the status of a website module.
     *
     * @param int $moduleId
     * @return Website
     * @throws ApiException
     */
    public function get(
        int $moduleId
    )
    {
        $request = $this->api->newRequest()
            ->get('website')
            ->parameter('module_id', $moduleId);

        $response = $this->api->call($request);

        if($response->isSuccessFull())
            return $this->transformer->transformGetResponse(
                $response
            );

        throw new ApiException($response);
    }
}