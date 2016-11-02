<?php

namespace Smoothy\Api\Responses\Cache;

use Illuminate\Cache\TaggedCache;

class SmoothyCache
{
    /**
     * @param string $key
     * @param $value
     */
    public function forever(string $key, $value)
    {
        \Cache::forever(
            $this->getKey($key),
            $value
        );
    }

    /**
     * @param string $key
     * @param $default
     * @return string|null
     */
    public function get(string $key, $default = null)
    {
        return \Cache::get(
            $this->getKey($key),
            $default
        );
    }

    /**
     * @param string $key
     * @param $value
     * @param null $minutes
     */
    public function put(string $key, $value, $minutes = null)
    {
        \Cache::put(
            $this->getKey($key),
            $value,
            $minutes
        );
    }

    /**
     * @param $tags
     * @return TaggedCache
     */
    public function tags($tags)
    {
        return \Cache::tags($tags);
    }

    /**
     * @param string $key
     * @return string
     */
    private function getKey(string $key)
    {
        return 'client-'.smoothy_config('api-client-id').':'.$key;
    }
}