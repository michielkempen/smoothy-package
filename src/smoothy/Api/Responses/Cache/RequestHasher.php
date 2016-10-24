<?php

namespace Smoothy\Api\Responses\Cache;

use GuzzleHttp\Psr7\Request;

class RequestHasher
{
    /**
     * Get a hash value for the given request.
     *
     * @param Request $request
     * @return string
     */
    public function getHashFor(Request $request)
    {
        if ($request->getUri()->getScheme() === 'https') {
            $request = $request->withRequestTarget((string) $request->getUri());
        }

        return 'smoothy-api-cache-'.md5(
            \GuzzleHttp\Psr7\str($request)
        );
    }
}