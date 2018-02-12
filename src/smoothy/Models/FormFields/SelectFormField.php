<?php

namespace Smoothy\Models\FormFields;

use Illuminate\Support\Collection;
use Smoothy\Models\Translation;

class SelectFormField extends TextFormField
{
    /**
     * @var bool
     */
    private $multiple;

    /**
     * @var Collection
     */
    private $options;

    /**
     * SelectFormField constructor.
     *
     * @param Translation $label
     * @param Translation $hint
     * @param bool $required
     * @param bool $multiple
     * @param Collection $options
     */
    public function __construct(
        Translation $label,
        Translation $hint,
        bool $required,
        bool $multiple,
        Collection $options
    )
    {
        parent::__construct($label, new Translation([]), $hint, $required, false);

        $this->multiple = $multiple;
        $this->options = $options;
    }

    /**
     * @param string $language
     * @return array
     */
    public function getOptions(string $language = null) : array
    {
        $language = is_null($language) ? currentLocale() : $language;

        return $this->options->map(function($option) use ($language) {
            return array_key_exists($language, $option)
                ? $option[$language]
                : '';
        })->toArray();
    }

    /**
     * @return boolean
     */
    public function isMultiple(): bool
    {
        return $this->multiple;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'selectField';
    }
}