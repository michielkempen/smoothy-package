<?php

namespace Smoothy\Api\Responses\Models\Custom\Types\Fields;

use Smoothy\Models\FormFields\TextFormField;
use Smoothy\Models\Translation;

class TextField extends TextFormField implements Field
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
     * TextFormField constructor.
     * @param int $id
     * @param int $formId
     * @param Translation $label
     * @param Translation $placeholder
     * @param Translation $hint
     * @param bool $required
     */
    public function __construct(
        int $id,
        int $formId,
        Translation $label,
        Translation $placeholder,
        Translation $hint,
        bool $required
    )
    {
        parent::__construct($label, $placeholder, $hint, $required);

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
}