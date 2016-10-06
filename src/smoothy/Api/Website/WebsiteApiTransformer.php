<?php

namespace Smoothy\Api\Website;

use Smoothy\Api\Website\Models\Website;
use Smoothy\Foundation\Api\ApiResponse;

class WebsiteApiTransformer
{
    /**
     * @param ApiResponse $response
     * @return Website
     */
	public static function transformGetResponse(ApiResponse $response) : Website
	{
        return Website::create(
            $response->getContent()['data']
        );
	}
}