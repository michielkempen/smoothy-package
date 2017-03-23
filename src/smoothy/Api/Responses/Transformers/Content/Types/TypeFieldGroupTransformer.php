<?php

namespace Smoothy\Api\Responses\Transformers\Content\Types;

use Smoothy\Api\Responses\Models\Content\Types\TypeFieldGroup;
use Smoothy\Models\Translation;

class TypeFieldGroupTransformer
{
    /**
     * @param array $attributes
     * @return null
     */
    public function transform(array $attributes)
    {
        return new TypeFieldGroup(
            new Translation($attributes['heading']),
            new Translation($attributes['description']),
            collect($attributes['fields'])->map(function($field) {
                return (new TypeFieldTransformer)->transform($field);
            })
        );
    }
}