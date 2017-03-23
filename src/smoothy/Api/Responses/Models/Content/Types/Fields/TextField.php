<?php

namespace Smoothy\Api\Responses\Models\Content\Types\Fields;

use Smoothy\Models\FormFields\TextFormField;
use Smoothy\Models\Translation;

class TextField extends TextFormField implements TypeField
{
    /**
     * @var int
     */
    private $id;

    /**
     * TextFormField constructor.
     *
     * @param int $id
     * @param Translation $label
     * @param Translation $placeholder
     * @param Translation $hint
     * @param bool $required
     * @param bool $translatable
     */
    public function __construct(
        int $id,
        Translation $label,
        Translation $placeholder,
        Translation $hint,
        bool $required,
        bool $translatable
    )
    {
        parent::__construct($label, $placeholder, $hint, $required, $translatable);

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