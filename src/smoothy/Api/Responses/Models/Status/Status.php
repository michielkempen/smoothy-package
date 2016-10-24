<?php

namespace Smoothy\Api\Responses\Models\Status;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class Status
{
    /**
     * @var Carbon
     */
    private $timestamp;

    /**
     * @var Collection
     */
    private $apiCalls;

    /**
     * Status constructor.
     *
     * @param Carbon $timestamp
     * @param Collection $apiCalls
     */
    public function __construct(Carbon $timestamp, Collection $apiCalls)
    {
        $this->timestamp = $timestamp;
        $this->apiCalls = $apiCalls;
    }

    /**
     * @param array $attributes
     * @return Status
     */
    public static function create(array $attributes)
    {
        return new self(
            Carbon::parse($attributes['timestamp']['date']),
            collect($attributes['api_calls'])
        );
    }

    /**
     * @return Carbon
     */
    public function getTimestamp(): Carbon
    {
        return $this->timestamp;
    }

    /**
     * @return Collection
     */
    public function getApiCalls(): Collection
    {
        return $this->apiCalls;
    }
}