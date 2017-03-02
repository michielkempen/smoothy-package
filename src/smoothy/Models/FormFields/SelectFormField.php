<?php

namespace Smoothy\Models\FormFields;

use Illuminate\Support\Collection;
use Smoothy\Models\Translation;

class SelectFormField extends TextFormField
{
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
     * @param Collection $options
     */
    public function __construct(
        Translation $label,
        Translation $hint,
        bool $required,
        Collection $options
    )
    {
        parent::__construct($label, new Translation([]), $hint, $required);

        $this->options = $options;
    }

    /**
     * @param string $language
     * @return array
     */
    public function getOptions(string $language) : array
    {
        return $this->options->map(function($option) use ($language) {
            return array_key_exists($language, $option)
                ? $option[$language]
                : '';
        })->toArray();
    }

    /**
     * @return Collection
     */
    public function serialize() : Collection
    {
        return parent::serialize()->merge([
            'type' => 'selectField',
            'options' => $this->getOptions(currentLocale())
        ]);
    }
}