<?php

namespace Smoothy\Api\Wrapper\Custom\Modules;

use Smoothy\Api\Requests\SmoothyApiRequest;
use Smoothy\Api\Responses\Transformers\Custom\Modules\GetTransformer;

class ModulesApi
{
    /**
     * @param int $moduleId
     * @return SmoothyApiRequest
     */
    public function get(int $moduleId)
    {
        return (new SmoothyApiRequest)
            ->get('custom/'.$moduleId)
            ->transform(new GetTransformer);
    }
}