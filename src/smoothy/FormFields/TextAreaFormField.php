<?php

namespace Smoothy\FormFields;

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