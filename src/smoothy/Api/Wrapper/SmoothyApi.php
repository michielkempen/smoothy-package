<?php

namespace Smoothy\Api\Wrapper;

use Smoothy\Api\Wrapper\Content\ContentApi;
use Smoothy\Api\Wrapper\Website\WebsiteApi;

class SmoothyApi
{
    /**
     * @return ContentApi
     */
    public function content() : ContentApi
    {
        return new ContentApi;
    }

    /**
     * @return WebsiteApi
     */
    public function website() : WebsiteApi
    {
        return new WebsiteApi;
    }
}