<?php

namespace Smoothy\Api\Responses\Models\Custom\Forms\Fields;

use Illuminate\Support\Collection;
use Smoothy\Models\FormFields\FilesFormField as FilesField;
use Smoothy\Models\Translation;

class FilesFormField extends FilesField implements FormField
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
     * FilesField constructor.
     * @param int $id
     * @param int $formId
     * @param Translation $label
     * @param Translation $hint
     * @param bool $required
     * @param bool $multiple
     * @param Collection $fileTypes
     */
    public function __construct(
        int $id,
        int $formId,
        Translation $label,
        Translation $hint,
        bool $required,
        bool $multiple,
        Collection $fileTypes
    )
    {
        parent::__construct($label, $hint, $required, $multiple, $fileTypes);

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