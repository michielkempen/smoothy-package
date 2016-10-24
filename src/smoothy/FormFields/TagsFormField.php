<?php

namespace Smoothy\FormFields;

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