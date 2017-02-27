<?php

namespace Smoothy\Api\Wrapper;

use Smoothy\Api\Wrapper\Custom\CustomApi;
use Smoothy\Api\Wrapper\Website\WebsiteApi;

class SmoothyApi
{
    /**
     * @return CustomApi
     */
    public function custom() : CustomApi
    {
        return new CustomApi;
    }

    /**
     * @return WebsiteApi
     */
    public function website() : WebsiteApi
    {
        return new WebsiteApi;
    }
}