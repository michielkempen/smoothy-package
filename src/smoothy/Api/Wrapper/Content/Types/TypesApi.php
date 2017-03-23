<?php

namespace Smoothy\Api\Wrapper\Content\Types;

use Smoothy\Api\Requests\SmoothyApiRequest;
use Smoothy\Api\Responses\Transformers\Content\Types\GetTransformer;

class TypesApi
{
    /**
     * @param int $moduleId
     * @param int $parentItemId
     * @param int $typeId
     * @return SmoothyApiRequest
     */
    public function get(int $moduleId, int $parentItemId, int $typeId)
    {
        return (new SmoothyApiRequest)
            ->get('content/'.$moduleId.'/'.$parentItemId.'/types/'.$typeId)
            ->transform(new GetTransformer);
    }
}