<?php

namespace Smoothy\Api\Wrapper\Custom;

use Smoothy\Api\Wrapper\Custom\Forms\FormsApi;
use Smoothy\Api\Wrapper\Custom\Items\ItemsApi;
use Smoothy\Api\Wrapper\Custom\Types\TypesApi;
use Smoothy\Api\Wrapper\Custom\Modules\ModulesApi;

class CustomApi
{
    /**
     * @return ModulesApi
     */
    public function modules() : ModulesApi
    {
        return new ModulesApi;
    }

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

    /**
     * @return FormsApi
     */
    public function forms() : FormsApi
    {
        return new FormsApi;
    }
}