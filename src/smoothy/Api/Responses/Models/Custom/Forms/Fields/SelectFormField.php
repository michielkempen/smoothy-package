<?php

namespace Smoothy\Api\Responses\Models\Custom\Forms\Fields;

use Illuminate\Support\Collection;
use Smoothy\Models\FormFields\SelectFormField as SelectField;
use Smoothy\Models\Translation;

class SelectFormField extends SelectField implements FormField
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

    /**
     * @return bool
     */
    public function isMultiple()
    {
        return false; // TODO: change
    }

    /**
     * @return Collection
     */
    public function serialize() : Collection
    {
        return parent::serialize()->merge([
            'id' => $this->id,
            'name' => $this->getName(),
            'form_id' => $this->getFormId()
        ]);
    }
}