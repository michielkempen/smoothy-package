<?php

namespace Smoothy\Models\FormFields;

use Illuminate\Support\Collection;

class TextAreaFormField extends TextFormField
{
    /**
     * @return Collection
     */
    public function serialize() : Collection
    {
        return parent::serialize()->merge([
            'type' => 'textAreaField'
        ]);
    }
}