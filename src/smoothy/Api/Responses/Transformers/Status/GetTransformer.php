<?php

namespace Smoothy\Api\Responses\Transformers\Status;

use Smoothy\Api\Responses\Models\Status\Status;
use Smoothy\Api\Responses\Transformers\Transformer;
use Smoothy\Api\Responses\SmoothyApiResponse;

class GetTransformer extends Transformer
{
    /**
     * @param SmoothyApiResponse $response
     * @return Status
     */
    public function transform(SmoothyApiResponse $response)
    {
        return $this->item($response, function($data) {
            return Status::create($data);
        });
    }
}