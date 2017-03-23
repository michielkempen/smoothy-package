<?php

namespace Smoothy\Models\FormFields;

use Illuminate\Support\Collection;
use Smoothy\Models\Translation;

class TextFormField extends FormField
{
    /**
     * @var Translation
     */
    private $placeholder;

    /**
     * @var bool
     */
    private $translatable;

    /**
     * TextFormField constructor.
     * @param Translation $label
     * @param Translation $placeholder
     * @param Translation $hint
     * @param bool $required
     * @param bool $translatable
     */
    public function __construct(
        Translation $label,
        Translation $placeholder,
        Translation $hint,
        bool $required,
        bool $translatable
    )
    {
        parent::__construct($label, $hint, $required);

        $this->placeholder = $placeholder;
        $this->translatable = $translatable;
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
     * @return bool
     */
    public function isTranslatable(): bool
    {
        return $this->translatable;
    }

    /**
     * @return Collection
     */
    public function serialize() : Collection
    {
        return parent::serialize()->merge([
            'type' => 'textField',
            'placeholder' => (string) $this->placeholder,
            'translatable' => $this->translatable
        ]);
    }
}