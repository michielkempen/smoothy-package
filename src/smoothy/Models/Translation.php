<?php

namespace Smoothy\Models;

use Illuminate\Support\Collection;

class Translation
{
    /**
     * @var Collection
     */
    private $translations;

    /**
     * Translation constructor.
     *
     * @param string|array $translation
     * @throws \Exception
     */
    public function __construct($translation)
    {
        if(is_array($translation))
            $this->translations = new Collection($translation);
        elseif(is_string($translation))
            $this->translations = new Collection([currentLocale() => $translation]);
        else
            throw new \Exception('The given translation must be a string or an array.');
    }

    /**
     * @param string $language
     * @return string
     */
    public function language(string $language)
    {
        return $this->translations->get($language, '');
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->translations->get(currentLocale(), '');
    }
}