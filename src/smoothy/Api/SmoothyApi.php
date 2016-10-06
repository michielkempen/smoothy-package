<?php

namespace Smoothy\Api;

use Smoothy\Api\Custom\CustomApi;
use Smoothy\Api\FormBuilder\FormBuilderApi;
use Smoothy\Foundation\Api\Api;
use Smoothy\Api\Website\WebsiteApi;

class SmoothyApi extends Api
{
    private $cacheTTL = 0;
    private $force = false;

    /**
     * @return SmoothyApiRequest
     */
    public function newRequest() : SmoothyApiRequest
    {
        $request = new SmoothyApiRequest;

        if($this->cacheTTL > 0)
            $request->cache($this->cacheTTL);

        if($this->force)
            $request->force();

        return $request;
    }

    /**
     * @param int $cacheTTL
     * @return SmoothyApi $this
     */
    public function cache(int $cacheTTL) : SmoothyApi
    {
        $this->cacheTTL = $cacheTTL;
        return $this;
    }

    /**
     * @return SmoothyApi $this
     */
    public function force() : SmoothyApi
    {
        $this->force = true;
        return $this;
    }

    /**
     * @return CustomApi
     */
    public function custom() : CustomApi
    {
        return new CustomApi($this);
    }

    /**
     * @return FormBuilderApi
     */
    public function formBuilder() : FormBuilderApi
    {
        return new FormBuilderApi($this);
    }

    /**
     * @return WebsiteApi
     */
    public function website() : WebsiteApi
    {
        return new WebsiteApi($this);
    }
}