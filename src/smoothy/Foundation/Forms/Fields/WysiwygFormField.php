<?php

namespace Smoothy\Foundation\Forms\Fields;

class WysiwygFormField extends TextAreaFormField
{
    /**
     * TextFormField constructor.
     * @param string $label
     * @param string $hint
     * @param bool $required
     */
    public function __construct(
        string $label,
        string $hint,
        bool $required
    )
    {
        parent::__construct($label, [], $hint, $required);
    }

    /**
     * @return string
     */
    public function getView() : string
    {
        return 'form.fields.wysiwygField';
    }
}