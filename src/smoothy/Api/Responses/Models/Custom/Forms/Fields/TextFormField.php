<?php

namespace Smoothy\Api\Responses\Models\Custom\Forms\Fields;

use Illuminate\Support\Collection;
use Smoothy\Models\FormFields\TextFormField as TextField;
use Smoothy\Models\Translation;

class TextFormField extends TextField implements FormField
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