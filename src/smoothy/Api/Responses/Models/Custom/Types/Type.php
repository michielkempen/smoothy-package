<?php

namespace Smoothy\Api\Responses\Models\Custom\Types;

use Illuminate\Support\Collection;
use Smoothy\Models\Translation;

class Type
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Translation
     */
    private $name;

    /**
     * @var Collection
     */
    private $fields;

    /**
     * Type constructor.
     *
     * @param int $id
     * @param Translation $name
     * @param Collection $fields
     */
    public function __construct(
        int $id,
        Translation $name,
        Collection $fields
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->fields = $fields;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Translation
     */
    public function getName(): Translation
    {
        return $this->name;
    }

    /**
     * @return Collection
     */
    public function getFields(): Collection
    {
        return $this->fields;
    }
}