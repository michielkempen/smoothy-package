<?php

namespace Smoothy\Api\Custom\Models\Field;

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
    public function getTypeId() : int;
}