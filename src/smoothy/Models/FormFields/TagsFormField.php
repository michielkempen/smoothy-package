<?php

namespace Smoothy\Models\FormFields;

class TagsFormField extends TextFormField
{
    /**
     * @return string
     */
    public function getView() : string
    {
        return 'smoothy::form.fields.tagsField';
    }
}