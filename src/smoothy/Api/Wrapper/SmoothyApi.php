<?php

namespace Smoothy\Api\Wrapper;

use Smoothy\Api\Wrapper\Custom\CustomApi;
use Smoothy\Api\Wrapper\FormBuilder\FormBuilderApi;
use Smoothy\Api\Wrapper\Status\StatusApi;
use Smoothy\Api\Wrapper\Website\WebsiteApi;

class SmoothyApi
{
    /**
     * @return StatusApi
     */
    public function status() : StatusApi
    {
        return new StatusApi;
    }

    /**
     * @return CustomApi
     */
    public function custom() : CustomApi
    {
        return new CustomApi;
    }

    /**
     * @return FormBuilderApi
     */
    public function formBuilder() : FormBuilderApi
    {
        return new FormBuilderApi;
    }

    /**
     * @return WebsiteApi
     */
    public function website() : WebsiteApi
    {
        return new WebsiteApi;
    }
}