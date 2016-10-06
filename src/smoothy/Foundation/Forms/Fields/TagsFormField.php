<?php

namespace Smoothy\Foundation\Forms\Fields;

class TagsFormField extends TextFormField
{
    /**
     * @return string
     */
    public function getView() : string
    {
        return 'form.fields.tagsField';
    }
}