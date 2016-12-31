<?php

namespace Smoothy\Api\Responses\Models\Custom\Forms\Fields;

use Smoothy\Models\FormFields\BooleanFormField as BooleanField;
use Smoothy\Models\Translation;

class BooleanFormField extends BooleanField implements FormField
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $formId;

    /**
     * BooleanField constructor.
     * @param int $id
     * @param int $formId
     * @param Translation $label
     * @param Translation $hint
     * @param bool $required
     */
    public function __construct(
        int $id,
        int $formId,
        Translation $label,
        Translation $hint,
        bool $required
    )
    {
        parent::__construct($label, $hint, $required);

        $this->id = $id;
        $this->formId = $formId;
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
    public function getFormId() : int
    {
        return $this->formId;
    }
}