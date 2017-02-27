<?php

return [

    /*
     * license id
     */
    'license-id' => env('SMOOTHY_LICENSE_ID'),

    /*
     * API access token
     */
    'access-token' => env('SMOOTHY_ACCESS_TOKEN', null),

    /*
     * The lifetime in minutes of the api responses in the cache.
     */
    'cache-ttl' => env('SMOOTHY_CACHE_TTL', 10),

    /*
     * The secret to sign image manipulation requests.
     */
    'image-secret' => env('SMOOTHY_IMAGE_SECRET'),

    /*
     * API configuration
     */
    'api' => [

        'website' => [
            'module_id' => null
        ],

    ]

];