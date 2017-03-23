<?php

namespace Smoothy\Api\Responses\Transformers\Content\Types;

use Smoothy\Api\Responses\Models\Content\Types\Type;
use Smoothy\Api\Responses\Transformers\ModelTransformer;
use Smoothy\Models\Translation;

class TypeTransformer extends ModelTransformer
{
    /**
     * @param array $attributes
     * @return mixed
     */
    public function transform(array $attributes)
    {
        return new Type(
            $attributes['id'],
            collect($attributes['field_groups'])->map(function($fieldGroup) {
                return (new TypeFieldGroupTransformer)->transform($fieldGroup);
            }),
            is_null($attributes['notification']) ? null : new Translation($attributes['notification'])
        );
    }
}