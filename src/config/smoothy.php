<?php

return [

    /*
     * license id
     */
    'license-id' => env('SMOOTHY_LICENSE_ID'),

    /*
     * API access token
     */
    'api-key' => env('SMOOTHY_API_KEY', null),

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

        // website

        'website' => [
            'id' => 0,
            'parent_item' => 0
        ],

    ]

];