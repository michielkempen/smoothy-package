<?php

function smoothy_path(string $path = '')
{
    return base_path('smoothy/src/'.$path);
}

function smoothy_config(string $configKey)
{
    return config('smoothy.'.env('SMOOTHY_API_ENV', 'production').'.'.$configKey);
}

function apiIsSetup() : bool
{
    return cache()->has('api-access-token');
}

function getClassName($parameter, bool $shorten = true)
{
    $class = is_object($parameter)
        ? get_class($parameter)
        : $parameter;

    return $shorten
        ? substr($class, strrpos($class, '\\') + 1)
        : $class;
}

function currentLocale()
{
    return \App::getLocale();
}