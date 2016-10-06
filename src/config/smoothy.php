<?php

return [

    /*
     * Defines if the laravel-localization middleware is loaded onto the routes.
     */
    'multi-lingual' => env('MULTI_LINGUAL', true),

    /*
     * The lifetime in minutes of the api responses in the cache.
     */
    'api-cache-ttl' => env('API_CACHE_TTL', 10),

];