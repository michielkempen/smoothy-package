<?php

namespace Smoothy\Models\FormFields;

use Smoothy\Models\Translation;

abstract class FormField
{
    /**
     * @var Translation
     */
    private $label;

    /**
     * @var Translation
     */
    private $hint;

    /**
     * @var bool
     */
    private $required;

    /**
     * FormField constructor.
     *
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
        $this->label = $label;
        $this->hint = $hint;
        $this->required = $required;
    }

    /**
     * @return Translation|null
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return Translation|null
     */
    public function getHint()
    {
        return $this->hint;
    }

    /**
     * @param string $language
     * @return bool
     */
    public function hasHint(string $language) : bool
    {
        return $this->hint->language($language) != '';
    }

    /**
     * @return bool
     */
    public function isRequired() : bool
    {
        return $this->required;
    }

    /**
     * @return string
     */
    public abstract function getView() : string;
}