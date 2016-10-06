<?php

function smoothy_config(string $configKey)
{
    return config('smoothy.'.env('SMOOTHY_API_ENV', 'production').'.'.$configKey);
}

function apiIsSetup() : bool
{
    return cache()->has('api-access-token');
}

function currentLocale()
{
    return \App::getLocale();
}