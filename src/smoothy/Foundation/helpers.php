<?php

function smoothy_config(string $configKey, $default = null)
{
    $configValue = config('smoothy.'.$configKey);

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

function manipulateImage(string $fileName, array $manipulations)
{
    return app(\Smoothy\Foundation\Images\ImageManipulator::class)->manipulate($fileName, $manipulations);
}