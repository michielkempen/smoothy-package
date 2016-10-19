<?php

namespace Smoothy\Api\Website;

use Smoothy\Api\Website\Models\Website;
use Smoothy\Foundation\Api\ApiResponse;
use Smoothy\Foundation\Api\ApiTransformer;

class WebsiteApiTransformer extends ApiTransformer
{
    /**
     * @param ApiResponse $response
     * @return Website
     */
	public function transformGetResponse(ApiResponse $response) : Website
	{
        return Website::create(
            $response->getContent()['data']
        );
	}
}