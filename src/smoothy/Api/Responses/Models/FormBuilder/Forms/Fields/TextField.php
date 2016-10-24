<?php

namespace Smoothy\Api\Responses\Models\FormBuilder\Forms\Fields;

use Illuminate\Support\Collection;
use Smoothy\FormFields\TextFormField;

class TextField extends TextFormField implements Field
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
     * @param Collection $label
     * @param Collection $placeholder
     * @param Collection $hint
     * @param bool $required
     */
    public function __construct(
        int $id,
        int $formId,
        Collection $label,
        Collection $placeholder,
        Collection $hint,
        bool $required
    )
    {
        parent::__construct($label, $placeholder, $hint, $required);

        $this->id = $id;
        $this->formId = $formId;
    }

    /**
     * @param array $attributes
     * @return TextField
     */
    public static function create(array $attributes)
    {
        return new static(
            $attributes['id'],
            $attributes['form_id'],
            collect($attributes['label']),
            collect($attributes['placeholder']),
            collect($attributes['hint']),
            $attributes['required']
        );
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