<?php

namespace Smoothy\FormFields;

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