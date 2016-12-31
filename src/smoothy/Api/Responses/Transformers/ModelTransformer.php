<?php

namespace Smoothy\Api\Responses\Transformers;

abstract class ModelTransformer
{
    /**
     * @param array $attributes
     * @return mixed
     */
    public abstract function transform(array $attributes);
}