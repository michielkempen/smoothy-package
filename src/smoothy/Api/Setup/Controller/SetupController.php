<?php

namespace Smoothy\Api\Setup\Controller;

use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Smoothy\Api\Responses\Cache\SmoothyCache;

class SetupController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function callback(Request $request)
    {
        $scheme = smoothy_config('api-scheme');
        if($scheme == null)
            throw new \Exception('No API scheme set.');

        $host = smoothy_config('api-host');
        if($host == null)
            throw new \Exception('No API host set.');

        $url = $scheme.'://'.rtrim($host, '/').'/token';

        $response = (new Client)->post($url, [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => smoothy_config('api-client-id'),
                'client_secret' => smoothy_config('api-client-secret'),
                'redirect_uri' => route('api-callback'),
                'code' => $request->code
            ]
        ]);

        (new SmoothyCache)->storeAccessToken(
            json_decode((string) $response->getBody(), true)['access_token']
        );

        return redirect('');
    }
}