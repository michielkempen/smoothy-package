<?php

namespace Smoothy\Api\Responses\Models\Content\Types;

use Illuminate\Support\Collection;
use Smoothy\Api\Responses\Models\Content\Types\Fields\TypeField;
use Smoothy\Models\Translation;

class TypeFieldGroup
{
    /**
     * @var Translation
     */
    private $heading;

    /**
     * @var Translation
     */
    private $description;

    /**
     * @var Collection
     */
    private $fields;

    /**
     * TypeFieldGroup constructor.
     *
     * @param Translation $heading
     * @param Translation $description
     * @param Collection $fields
     * @internal param int $id
     */
    public function __construct(
        Translation $heading,
        Translation $description,
        Collection $fields
    )
    {
        $this->heading = $heading;
        $this->description = $description;
        $this->fields = $fields;
    }

    /**
     * @return Translation
     */
    public function getHeading(): Translation
    {
        return $this->heading;
    }

    /**
     * @return Translation
     */
    public function getDescription(): Translation
    {
        return $this->description;
    }

    /**
     * @return Collection
     */
    public function getFields(): Collection
    {
        return $this->fields;
    }

    /**
     * @return Collection
     */
    public function serialize() : Collection
    {
        return new Collection([
            'heading' => (string) $this->getHeading(),
            'description' => (string) $this->getDescription(),
            'fields' => $this->getFields()->map(function(TypeField $field) {
                $serialization = new Collection(['name' => $field->getName()]);
                return $serialization->merge($field->serialize());
            })
        ]);
    }
}