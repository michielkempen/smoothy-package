<?php

namespace Smoothy\Foundation\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;

class SetupController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function callback(Request $request)
    {
        $scheme = env('SMOOTHY_API_SCHEME');
        if($scheme == null)
            throw new \Exception('No API scheme set.');

        $host = env('SMOOTHY_API_HOST');
        if($host == null)
            throw new \Exception('No API host set.');

        $url = $scheme.'://'.rtrim($host, '/').'/token';

        $response = (new Client)->post($url, [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => env('SMOOTHY_API_CLIENT_ID'),
                'client_secret' => env('SMOOTHY_API_CLIENT_SECRET'),
                'redirect_uri' => url('/api-callback'),
                'code' => $request->code
            ]
        ]);

        Cache::forever(
            'api-access-token',
            json_decode((string) $response->getBody(), true)['access_token']
        );

        return redirect('');
    }
}