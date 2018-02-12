<?php

namespace Smoothy\Models\FormFields;

class TextAreaFormField extends TextFormField
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'textAreaField';
    }
}