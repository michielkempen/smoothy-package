<?php

namespace Smoothy\Api\Responses\Models\Custom\Forms;

use Illuminate\Support\Collection;
use Smoothy\Models\Translation;

class Form
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Translation
     */
    private $successMessage;

    /**
     * @var Collection
     */
    private $fields;

    /**
     * Form constructor.
     *
     * @param int $id
     * @param Translation $successMessage
     * @param Collection $fields
     */
    public function __construct(
        int $id,
        Translation $successMessage,
        Collection $fields
    )
    {
        $this->id = $id;
        $this->successMessage = $successMessage;
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
    public function getSuccessMessage()
    {
        return $this->successMessage;
    }

    /**
     * @return Collection
     */
    public function getFields(): Collection
    {
        return $this->fields;
    }
}