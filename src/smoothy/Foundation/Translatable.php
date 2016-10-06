<?php

namespace Smoothy\Foundation;

trait Translatable
{
    /**
     * @param $field
     * @param string|null $language
     * @return string|array
     */
    public function getTranslation($field, string $language = null)
    {
        if($language == null)
            return $field;

        return array_key_exists($language, $field)
            ? $field[$language]
            : '';
    }
}