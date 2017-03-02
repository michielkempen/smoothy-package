<?php

namespace Smoothy\Models\FormFields;

use Illuminate\Support\Collection;

class BooleanFormField extends FormField
{
    /**
     * @return Collection
     */
    public function serialize() : Collection
    {
        return parent::serialize()->merge([
            'type' => 'booleanField'
        ]);
    }
}