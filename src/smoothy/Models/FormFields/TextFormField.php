<?php

namespace Smoothy\Models\FormFields;

use Smoothy\Models\Translation;

class TextFormField extends FormField
{
    /**
     * @var Translation
     */
    private $placeholder;

    /**
     * TextFormField constructor.
     * @param Translation $label
     * @param Translation $placeholder
     * @param Translation $hint
     * @param bool $required
     */
    public function __construct(
        Translation $label,
        Translation $placeholder,
        Translation $hint,
        bool $required
    )
    {
        parent::__construct($label, $hint, $required);

        $this->placeholder = $placeholder;
    }

    /**
     * @return Translation
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * @param string $language
     * @return bool
     */
    public function hasPlaceholder(string $language) : bool
    {
        return $this->placeholder->language($language) != '';
    }

    /**
     * @return string
     */
    public function getView() : string
    {
        return 'smoothy::form.fields.textField';
    }
}