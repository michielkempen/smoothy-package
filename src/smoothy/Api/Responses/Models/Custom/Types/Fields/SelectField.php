<?php

namespace Smoothy\Api\Responses\Models\Custom\Types\Fields;

use Illuminate\Support\Collection;
use Smoothy\Models\FormFields\SelectFormField;
use Smoothy\Models\Translation;

class SelectField extends SelectFormField implements Field
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $typeId;

    /**
     * SelectField constructor.
     * @param int $id
     * @param int $formId
     * @param Translation $label
     * @param Translation $hint
     * @param bool $required
     * @param Collection $options
     */
    public function __construct(
        int $id,
        int $formId,
        Translation $label,
        Translation $hint,
        bool $required,
        Collection $options
    )
    {
        parent::__construct($label, $hint, $required, $options);

        $this->id = $id;
        $this->typeId = $formId;
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

    /**
     * @return int
     */
    public function getTypeId() : int
    {
        return $this->typeId;
    }

    /**
     * @return bool
     */
    public function isMultiple()
    {
        return false; // TODO: change
    }
}