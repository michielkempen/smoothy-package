<?php

namespace Smoothy\Foundation\Forms\Fields;

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