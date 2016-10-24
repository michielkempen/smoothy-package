<?php

namespace Smoothy\Api\Wrapper\Custom\Types;

use Smoothy\Api\Requests\SmoothyApiRequest;
use Smoothy\Api\Responses\Transformers\Custom\Types\AllTransformer;
use Smoothy\Api\Responses\Transformers\Custom\Types\GetTransformer;

class TypesApi
{
    /**
     * @param int $moduleId
     * @return SmoothyApiRequest
     */
    public function all(int $moduleId)
    {
        return (new SmoothyApiRequest)
            ->get('custom/'.$moduleId.'/types')
            ->transform(new AllTransformer);
    }

    /**
     * @param int $moduleId
     * @param int $typeId
     * @return SmoothyApiRequest
     */
    public function get(int $moduleId, int $typeId)
    {
        return (new SmoothyApiRequest)
            ->get('custom/'.$moduleId.'/types/'.$typeId)
            ->transform(new GetTransformer);
    }
}