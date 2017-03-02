<?php

namespace Smoothy\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as BaseRouteServiceProvider;
use Illuminate\Routing\Router;

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
        require __DIR__ . '/../../helpers/routeHelpers.php';

        $router->group(['middleware' => 'web'], function ($router) {

            require base_path('routes/web.php');

            $router->group(['middleware' => 'ajax'], function () {

                require base_path('routes/api.php');

            });

        });
    }
}