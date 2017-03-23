<?php

namespace Smoothy\Api\Responses\Models\Content\Types\Fields;

use Illuminate\Support\Collection;
use Smoothy\Models\FormFields\SelectFormField;
use Smoothy\Models\Translation;

class SelectField extends SelectFormField implements TypeField
{
    /**
     * @var int
     */
    private $id;

    /**
     * SelectField constructor.
     *
     * @param int $id
     * @param Translation $label
     * @param Translation $hint
     * @param bool $required
     * @param bool $multiple
     * @param Collection $options
     */
    public function __construct(
        int $id,
        Translation $label,
        Translation $hint,
        bool $required,
        bool $multiple,
        Collection $options
    )
    {
        parent::__construct($label, $hint, $required, $multiple, $options);

        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return 'field'.$this->getId();
    }
}