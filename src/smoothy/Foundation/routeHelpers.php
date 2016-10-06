<?php

/**
 * @param $route
 * @param $alias
 * @param $controllerGetMethod
 * @param $controllerPostMethod
 */
function registerGetAndPost($route, $alias, $controllerGetMethod, $controllerPostMethod)
{
    registerGet($route, $alias, $controllerGetMethod);
    registerPost($route, $alias, $controllerPostMethod);
}

/**
 * @param $route
 * @param $alias
 * @param $controllerMethod
 */
function registerGet($route, $alias, $controllerMethod)
{
    Route::get($route, [
        'as' => $alias,
        'uses'  => $controllerMethod
    ]);
}

/**
 * @param $route
 * @param $alias
 * @param $controllerMethod
 */
function registerPost($route, $alias, $controllerMethod)
{
    Route::post($route, [
        'as' => $alias,
        'uses'  => $controllerMethod
    ]);
}
