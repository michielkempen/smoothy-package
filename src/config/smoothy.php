<?php

return [

    /*
     * Scheme of the application.
     */
    'scheme' => env('SCHEME', 'http'),

    /*
     * Defines if the laravel-localization middleware is loaded onto the routes.
     */
    'multi-lingual' => env('MULTI_LINGUAL', true),

    /*
     * Defines whether the application makes use of the API facilities.
     */
    'api-enabled' => env('SMOOTHY_API_ENABLED', false),

    /*
     * API environment.
     */
    'api-environment' => env('SMOOTHY_API_ENV', 'production'),

    /*
     * API scheme.
     */
    'api-scheme' => env('SMOOTHY_API_SCHEME', 'https'),

    /*
     * API host.
     */
    'api-host' => env('SMOOTHY_API_HOST', 'https://api.smoothy.nu'),

    /*
     * API client id.
     */
    'api-client-id' => env('SMOOTHY_API_CLIENT_ID'),

    /*
     * API client secret.
     */
    'api-client-secret' => env('SMOOTHY_API_CLIENT_SECRET'),

    /*
     * API access token.
     */
    'api-access-token' => env('SMOOTHY_API_ACCESS_TOKEN', cache()->get('api-access-token')),

    /*
     * The lifetime in minutes of the api responses in the cache.
     */
    'api-cache-ttl' => env('API_CACHE_TTL', 10),

];