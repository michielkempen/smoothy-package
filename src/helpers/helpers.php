<?php

/**
 * @param string $configKey
 * @return string
 */
function smoothy_api(string $configKey)
{
    return config('smoothy.api.'.$configKey);
}

/**
 * Get the current locale of the system.
 *
 * @return string
 */
function currentLocale()
{
    return \App::getLocale();
}

/**
 * @param string $string
 * @param int $id
 * @return string
 */
function slug(string $string, int $id)
{
    return \Slugify::slugify($string).'-'.$id;
}

/**
 * @param string $url
 * @return int
 */
function unslug(string $url)
{
    return (int) last(explode('-', $url));
}

/**
 * @param string $fileUrl
 * @param array $manipulations
 * @return string
 */
function manipulateImage(string $fileUrl, array $manipulations)
{
    $fileName = last(explode('/', $fileUrl));

    $filePath = app(\Smoothy\Api\Responses\Images\ImageManipulator::class)->manipulate($fileName, $manipulations);

    return 'https://app.smoothy.nu'.$filePath;
}