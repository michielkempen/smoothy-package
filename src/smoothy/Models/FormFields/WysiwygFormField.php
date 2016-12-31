<?php

namespace Smoothy\Models\FormFields;

use Smoothy\Models\Translation;

class WysiwygFormField extends TextAreaFormField
{
    /**
     * TextFormField constructor.
     * @param Translation $label
     * @param Translation $hint
     * @param bool $required
     */
    public function __construct(
        Translation $label,
        Translation $hint,
        bool $required
    )
    {
        parent::__construct($label, collect(), $hint, $required);
    }

    /**
     * @return string
     */
    public function getView() : string
    {
        return 'smoothy::form.fields.wysiwygField';
    }
}