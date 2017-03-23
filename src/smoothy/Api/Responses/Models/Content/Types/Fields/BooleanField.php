<?php

namespace Smoothy\Api\Responses\Models\Content\Types\Fields;

use Smoothy\Models\FormFields\BooleanFormField;
use Smoothy\Models\Translation;

class BooleanField extends BooleanFormField implements TypeField
{
    /**
     * @var int
     */
    private $id;

    /**
     * BooleanField constructor.
     *
     * @param int $id
     * @param Translation $label
     * @param Translation $hint
     * @param bool $required
     */
    public function __construct(
        int $id,
        Translation $label,
        Translation $hint,
        bool $required
    )
    {
        parent::__construct($label, $hint, $required);

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