<?php

namespace Smoothy\Api\Custom\Models\Field;

class TextField extends Field
{
    /**
     * @var array
     */
    private $placeholder;

    /**
     * @var bool
     */
    private $required;

    /**
     * @var bool
     */
    private $translatable;

    /**
     * TextField constructor.
     *
     * @param int $id
     * @param int $moduleId
     * @param bool $required
     * @param bool $translatable
     * @param array $label
     * @param array $placeholder
     * @param array $hint
     */
    public function __construct(
        int $id,
        int $moduleId,
        bool $required,
        bool $translatable,
        array $label,
        array $placeholder,
        array $hint
    )
    {
        parent::__construct($id, $moduleId, $label, $hint);

        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->translatable = $translatable;
    }

    /**
     * @param array $attributes
     * @return TextField
     */
    public static function create(array $attributes)
    {
        return new static(
            $attributes['id'],
            $attributes['module_id'],
            $attributes['required'],
            $attributes['translatable'],
            $attributes['label'],
            $attributes['placeholder'],
            $attributes['hint']
        );
    }

    /**
     * @param string $language
     * @return string
     */
    public function getPlaceholder(string $language = null)
    {
        return $this->getTranslation($this->placeholder, $language);
    }

    /**
     * @param string|null $language
     * @return bool
     */
    public function hasPlaceholder(string $language = null) : bool
    {
        return $this->getPlaceholder($language) != null;
    }

    /**
     * @return boolean
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * @return boolean
     */
    public function isTranslatable(): bool
    {
        return $this->translatable;
    }
}