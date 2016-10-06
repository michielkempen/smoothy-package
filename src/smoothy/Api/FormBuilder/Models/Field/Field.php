<?php

namespace Smoothy\Api\FormBuilder\Models\Field;

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