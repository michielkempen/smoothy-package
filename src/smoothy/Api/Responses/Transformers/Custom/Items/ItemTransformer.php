<?php

namespace Smoothy\Api\Responses\Transformers\Custom\Items;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Smoothy\Api\Responses\Models\Custom\Forms\Form;
use Smoothy\Api\Responses\Models\Custom\Items\Item;
use Smoothy\Api\Responses\Transformers\Custom\Forms\FormTransformer;
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
            $attributes['order'],
            $attributes['type_id'],
            $attributes['module_id'],
            $attributes['parent_item_id'],
            collect($attributes['languages']),
            Carbon::parse($attributes['date']['date']),
            $this->transformFields($attributes['fields']),
            $this->transformForm($attributes['form'])
        );
    }

    /**
     * @param array $fields
     * @return Collection
     */
    private function transformFields(array $fields)
    {
        return collect($fields)->mapToAssoc(function($field) {
            if($field['content_type'] == 'translation') {
                return [
                    $field['field_id'],
                    new Translation($field['value'])
                ];
            } else if($field['content_type'] == 'files') {
                return [
                    $field['field_id'],
                    new Collection($field['value'])
                ];
            } else {
                return [
                    $field['field_id'],
                    $field['value']
                ];
            }
        });
    }

    /**
     * @param $form
     * @return null|Form
     */
    private function transformForm($form)
    {
        return is_null($form)
            ? null
            : (new FormTransformer)->transform($form);
    }
}