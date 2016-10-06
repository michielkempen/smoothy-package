<?php

function smoothy_config(string $configKey, $default = null)
{
    $configValue = config('smoothy.'.env('SMOOTHY_API_ENV', 'production').'.'.$configKey);

    return is_null($configValue)
        ? $default
        : $configValue;
}

function smoothy_api(string $configKey)
{
    return config('smoothyapi.'.smoothy_config('api-environment').'.'.$configKey);
}

function api_needs_setup() : bool
{
    return !cache()->has('api-access-token');
}

function currentLocale()
{
    return \App::getLocale();
}