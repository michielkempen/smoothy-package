<?php

namespace Smoothy\Api\Responses\Models\FormBuilder\Forms\Fields;

interface Field
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return int
     */
    public function getFormId() : int;
}