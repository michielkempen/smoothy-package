<?php

namespace Smoothy\Api\Responses\Cache;

use Illuminate\Cache\TaggedCache;

class SmoothyCache
{
    /**
     * @param string $accessToken
     */
    public function storeAccessToken(string $accessToken)
    {
        \Cache::store('smoothy_access_tokens')->forever(
            'api-access-token-'.smoothy_config('api-client-id'),
            $accessToken
        );
    }

    /**
     * @param string $accessToken
     */
    public function getAccessToken(string $accessToken)
    {
        return \Cache::store('smoothy_access_tokens')->get($accessToken);
    }

    /**
     * @param string $key
     * @param $value
     */
    public function forever(string $key, $value)
    {
        \Cache::store('smoothy_cdn')->forever(
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
        return \Cache::store('smoothy_cdn')->get(
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
        \Cache::store('smoothy_cdn')->put(
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
        return \Cache::store('smoothy_cdn')->tags($tags);
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