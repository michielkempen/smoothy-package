<?php

namespace Smoothy\Api\Wrapper\Content;

use Smoothy\Api\Wrapper\Content\Items\ItemsApi;
use Smoothy\Api\Wrapper\Content\Types\TypesApi;

class ContentApi
{
    /**
     * @return TypesApi
     */
    public function types() : TypesApi
    {
        return new TypesApi;
    }

    /**
     * @return ItemsApi
     */
    public function items() : ItemsApi
    {
        return new ItemsApi;
    }
}