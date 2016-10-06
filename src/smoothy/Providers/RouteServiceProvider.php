<?php

namespace Smoothy\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as BaseRouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Smoothy\Foundation\Controllers\SetupController;

class RouteServiceProvider extends BaseRouteServiceProvider
{
    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        require __DIR__.'/../Foundation/routeHelpers.php';

        $router->group(['middleware' => 'web'], function () use ($router) {

            if(smoothy_config('api-enabled') && api_needs_setup()) {
                registerGet(
                    'api-callback',
                    'api-callback',
                    SetupController::class.'@callback'
                );
            }

            $router->group($this->getWebRouteOptions(), function () {
                require base_path('routes/web.php');
            });

            $router->get('language/{locale}', function(string $locale) {
                $url = \LaravelLocalization::getLocalizedURL($locale, url(''));
                return redirect($url);
            });
        });
    }

    /**
     * @return array
     */
    private function getWebRouteOptions() : array
    {
        if(!smoothy_config('multi-lingual'))
            return ['middleware' => 'api-setup'];

        return [
            'prefix' =>  \LaravelLocalization::setLocale(),
            'middleware' => [
                'api-setup',
                'localize',
                'localizationRedirect',
                'localeCookieRedirect'
            ]
        ];
    }
}