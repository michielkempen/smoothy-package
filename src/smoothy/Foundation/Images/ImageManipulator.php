<?php

namespace Smoothy\Foundation\Images;

use League\Glide\Urls\UrlBuilderFactory;

class ImageManipulator
{
    /**
     * ImageManipulator constructor.
     *
     * @param string $secret
     */
    public function __construct(string $secret)
    {
        $this->manipulator = UrlBuilderFactory::create(
            '/files/',
            $secret
        );
    }

    /**
     * @param string $fileName
     * @param array $manipulations
     * @return string
     */
    public function manipulate(string $fileName, array $manipulations)
    {
        return $this->manipulator->getUrl($fileName, $manipulations);
    }
}