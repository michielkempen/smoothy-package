<?php


namespace Smoothy\Api\Responses\Transformers\Custom\Modules;


use Smoothy\Api\Responses\Models\Custom\Modules\Module;
use Smoothy\Api\Responses\Transformers\Custom\Types\TypeTransformer;
use Smoothy\Api\Responses\Transformers\ModelTransformer;
use Smoothy\Models\Translation;

class ModuleTransformer extends ModelTransformer
{
    /**
     * @param array $attributes
     * @return mixed
     */
    public function transform(array $attributes)
    {
        return new Module(
            $attributes['id'],
            collect($attributes['languages']),
            new Translation($attributes['name']),
            collect($attributes['types'])->map(function($type) {
                return (new TypeTransformer)->transform($type);
            })
        );
    }
}