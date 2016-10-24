<?php

namespace Smoothy\Api\Responses\Images;

use League\Glide\Urls\UrlBuilderFactory;

class ImageManipulator
{
    /**
     * ImageManipulator constructor.
     *
     * @param string $secret
     * @throws \Exception
     */
    public function __construct(string $secret = null)
    {
        if(is_null($secret)) {
            throw new \Exception('No image manipulation secret set');
        }

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