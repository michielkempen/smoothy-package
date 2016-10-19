<?php

namespace Smoothy\Foundation\Forms\Fields;

use App\Foundation\Forms\Rules\RequiredRule;
use App\Foundation\Forms\Rules\ValidationRule;
use App\Foundation\Models\Translatable;
use Illuminate\Support\Collection;

abstract class FormField
{
    /**
     * @var Collection
     */
    private $label;

    /**
     * @var Collection
     */
    private $hint;

    /**
     * @var bool
     */
    private $required;

    /**
     * FormField constructor.
     *
     * @param Collection $label
     * @param Collection $hint
     * @param bool $required
     */
    public function __construct(
        Collection $label,
        Collection $hint,
        bool $required
    )
    {
        $this->label = $label;
        $this->hint = $hint;
        $this->required = $required;
    }

    /**
     * @param string $language
     * @return Collection|null|string
     */
    public function getLabel(string $language = null)
    {
        return is_null($language)
            ? $this->label
            : $this->label->get($language, null);
    }

    /**
     * @param string $language
     * @return Collection|null|string
     */
    public function getHint(string $language = null)
    {
        return is_null($language)
            ? $this->hint
            : $this->hint->get($language, null);
    }

    /**
     * @param string $language
     * @return bool
     */
    public function hasHint(string $language) : bool
    {
        return !is_null($this->getHint($language));
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