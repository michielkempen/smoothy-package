<?php

namespace Smoothy\Api\Setup\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Routing\Router;
use Smoothy\Api\Setup\Controller\SetupController;

class ApiRouteServiceProvider extends RouteServiceProvider
{
    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['middleware' => 'web'], function () use ($router) {

            if(smoothy_config('api-enabled') && smoothy_api_needs_setup()) {
                $router->get('api-callback', [
                    'as' => 'api-callback',
                    'uses' => SetupController::class.'@callback'
                ]);
            }

        });
    }
}