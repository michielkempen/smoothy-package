<?php

function smoothy_config(string $configKey)
{
    return config('smoothy.'.$configKey);
}

function smoothy_api(string $configKey)
{
    return config('smoothy-api.'.smoothy_config('api-environment').'.'.$configKey);
}

function api_needs_setup() : bool
{
    return !cache()->has('api-access-token');
}

function currentLocale()
{
    return \App::getLocale();
}