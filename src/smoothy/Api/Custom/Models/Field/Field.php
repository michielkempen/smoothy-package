<?php

namespace Smoothy\Api\Custom\Models\Field;

use Smoothy\Foundation\Translatable;

class Field
{
    use Translatable;

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $moduleId;

    /**
     * @var array
     */
    private $label;

    /**
     * @var array
     */
    private $hint;

    /**
     * Field constructor.
     * @param int $id
     * @param int $moduleId
     * @param array $label
     * @param array $hint
     */
    public function __construct(
        int $id,
        int $moduleId,
        array $label,
        array $hint
    )
    {
        $this->id = $id;
        $this->moduleId = $moduleId;
        $this->label = $label;
        $this->hint = $hint;
    }

    /**
     * @param array $attributes
     * @return Field
     */
    public static function create(array $attributes)
    {
        return new static(
            $attributes['id'],
            $attributes['module_id'],
            $attributes['label'],
            $attributes['hint']
        );
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

    /**
     * @return int
     */
    public function getModuleId() : int
    {
        return $this->moduleId;
    }

    /**
     * @param string $language
     * @return string
     */
    public function getLabel(string $language = null)
    {
        return $this->getTranslation($this->label, $language);
    }

    /**
     * @param string $language
     * @return string
     */
    public function getHint(string $language = null)
    {
        return $this->getTranslation($this->hint, $language);
    }

    /**
     * @param string|null $language
     * @return bool
     */
    public function hasHint(string $language = null) : bool
    {
        return $this->getHint($language) != null;
    }
}