<?php

namespace Smoothy\Api\Responses\Transformers\Custom\Modules;

use Smoothy\Api\Responses\Models\Custom\Modules\Module;
use Smoothy\Api\Responses\Transformers\ResponseTransformer;
use Smoothy\Api\Responses\SmoothyApiResponse;

class GetTransformer extends ResponseTransformer
{
    /**
     * @param SmoothyApiResponse $response
     * @return Module
     */
    public function transform(SmoothyApiResponse $response)
    {
        return $this->item($response, function($item) {
            return (new ModuleTransformer)->transform($item);
        });
    }
}