<?php

namespace Smoothy\Api\Responses\Models\Custom\Types\Fields;

use Illuminate\Support\Collection;
use Smoothy\FormFields\TextAreaFormField;

class TextAreaField extends TextAreaFormField implements Field
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
     * TextAreaField constructor.
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
        $this->typeId = $formId;
    }

    /**
     * @param array $attributes
     * @return TextAreaFormField
     */
    public static function create(array $attributes)
    {
        return new static(
            $attributes['id'],
            $attributes['type_id'],
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
    public function getTypeId() : int
    {
        return $this->typeId;
    }
}