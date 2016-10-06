<?php

namespace Smoothy\Api\Custom\Models\Field;

class SelectField extends TextField
{
    /**
     * @var int
     */
    private $minimumNumber;

    /**
     * @var int
     */
    private $maximumNumber;

    /**
     * @var array
     */
    private $options;

    /**
     * SelectField constructor.
     * @param array $label
     * @param array $hint
     * @param array $options
     * @param int $minimumNumber
     * @param int|null $maximumNumber
     * @param int $id
     * @param int $moduleId
     */
    public function __construct(
        int $id,
        int $moduleId,
        array $label,
        array $hint,
        array $options = [],
        int $minimumNumber,
        int $maximumNumber = null
    )
    {
        parent::__construct($id, $moduleId, $minimumNumber > 0, $label, [], $hint);

        $this->options = $options;
        $this->minimumNumber = $minimumNumber;
        $this->maximumNumber = $maximumNumber;
    }

    /**
     * @param array $attributes
     * @return SelectField
     */
    public static function create(array $attributes)
    {
        return new static(
            $attributes['id'],
            $attributes['module_id'],
            $attributes['label'],
            $attributes['hint'],
            $attributes['options'],
            $attributes['minimum_number'],
            $attributes['maximum_number']
        );
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getOption(string $key)
    {
        return $this->options[$key];
    }

    /**
     * @return int
     */
    public function getMinimumNumber()
    {
        return $this->minimumNumber;
    }

    /**
     * @return int
     */
    public function getMaximumNumber()
    {
        return $this->maximumNumber;
    }
}