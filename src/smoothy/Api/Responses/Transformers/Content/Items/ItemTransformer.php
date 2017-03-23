<?php

namespace Smoothy\Api\Responses\Transformers\Content\Items;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Smoothy\Api\Responses\Models\Content\Items\Item;
use Smoothy\Api\Responses\Transformers\ModelTransformer;
use Smoothy\Models\Translation;

class ItemTransformer extends ModelTransformer
{
    /**
     * @param array $attributes
     * @return Item
     */
    public function transform(array $attributes) : Item
    {
        return new Item(
            $attributes['id'],
            $attributes['module_id'],
            $attributes['parent_item_id'],
            $attributes['type_id'],
            collect($attributes['languages']),
            Carbon::parse($attributes['date']['date']),
            $this->transformFields($attributes['fields'])
        );
    }

    /**
     * @param array $fields
     * @return Collection
     */
    private function transformFields(array $fields)
    {
        $collection = new Collection;

        collect($fields)->each(function($field) use ($collection) {
            if($field['content_type'] == 'translation') {
                $collection->put($field['field_id'], new Translation($field['value']));
            } else if($field['content_type'] == 'files') {
                $collection->put($field['field_id'], new Collection($field['value']));
            } else {
                $collection->put($field['field_id'], $field['value']);
            }
        });

        return $collection;
    }
}