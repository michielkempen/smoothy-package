<?php

namespace Smoothy\Foundation\Forms\Fields;

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