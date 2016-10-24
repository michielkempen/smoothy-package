<?php

namespace Smoothy\Api\Wrapper\Status;

use Carbon\Carbon;
use Smoothy\Api\Requests\SmoothyApiRequest;
use Smoothy\Api\Responses\Transformers\Status\GetTransformer;

class StatusApi
{
    /**
     * Get the status of a website module.
     *
     * @param array $moduleIds
     * @param Carbon $timestamp
     * @return SmoothyApiRequest
     */
    public function get(array $moduleIds, Carbon $timestamp)
    {
        return (new SmoothyApiRequest)
            ->get('status')
            ->parameter('timestamp', $timestamp->toDateTimeString())
            ->parameter('module_ids', $moduleIds)
            ->transform(new GetTransformer);
    }
}