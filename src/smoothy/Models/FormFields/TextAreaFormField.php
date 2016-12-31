<?php

namespace Smoothy\Models\FormFields;

class TextAreaFormField extends TextFormField
{
    /**
     * @return string
     */
    public function getView() : string
    {
        return 'smoothy::form.fields.textAreaField';
    }
}