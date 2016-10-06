<?php

namespace Smoothy\Foundation\Forms\Fields;

use App\Foundation\Forms\Rules\RequiredRule;
use App\Foundation\Forms\Rules\ValidationRule;
use App\Foundation\Models\Translatable;
use Illuminate\Support\Collection;

abstract class FormField
{
    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $hint;

    /**
     * @var bool
     */
    private $required;

    /**
     * FormField constructor.
     *
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
        $this->label = $label;
        $this->hint = $hint;
        $this->required = $required;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getHint()
    {
        return $this->hint;
    }

    /**
     * @return bool
     */
    public function hasHint() : bool
    {
        return $this->getHint() != '';
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