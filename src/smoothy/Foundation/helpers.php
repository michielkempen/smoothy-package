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

function slug(string $string, int $id)
{
    return \Slugify::slugify($string).'-'.$id;
}

function unslug(string $url)
{
    return (int) last(explode('-', $url));
}

function manipulateImage(string $fileUrl, array $manipulations)
{
    $fileName = last(explode('/', $fileUrl));

    $filePath = app(\Smoothy\Foundation\Images\ImageManipulator::class)->manipulate($fileName, $manipulations);

    return smoothy_config('app-scheme').'://'.smoothy_config('app-host').$filePath;
}