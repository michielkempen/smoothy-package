<?php

namespace Smoothy\Models\FormFields;

class PasswordFormField extends TextFormField
{
    /**
     * @return string
     */
    public function getView() : string
    {
        return 'smoothy::form.fields.passwordField';
    }
}