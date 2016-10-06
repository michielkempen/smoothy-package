<?php


namespace Smoothy\Api\Custom\Models;

use Illuminate\Support\Collection;
use Smoothy\Api\Custom\Models\Field\BooleanField;
use Smoothy\Api\Custom\Models\Field\FilesField;
use Smoothy\Api\Custom\Models\Field\PasswordField;
use Smoothy\Api\Custom\Models\Field\SelectField;
use Smoothy\Api\Custom\Models\Field\TextAreaField;
use Smoothy\Api\Custom\Models\Field\TextField;
use Smoothy\Api\Custom\Models\Field\WysiwygField;

class Module
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var array
     */
    private $languages;

    /**
     * @var Collection
     */
    private $fields;

    /**
     * Module constructor.
     * @param int $id
     * @param array $languages
     * @param Collection $fields
     */
    public function __construct(int $id, array $languages, Collection $fields)
    {
        $this->id = $id;
        $this->languages = $languages;
        $this->fields = $fields;
    }

    /**
     * @param array $attributes
     * @return Module
     */
    public static function create(array $attributes)
    {
        return new self(
            $attributes['id'],
            $attributes['languages'],
            collect($attributes['fields'])->map(function($item) {
                switch ($item['type']) {
                    case getClassName(BooleanField::class):
                        return BooleanField::create($item);
                    case getClassName(FilesField::class):
                        return FilesField::create($item);
                    case getClassName(PasswordField::class):
                        return PasswordField::create($item);
                    case getClassName(SelectField::class):
                        return SelectField::create($item);
                    case getClassName(TextField::class):
                        return TextField::create($item);
                    case getClassName(TextAreaField::class):
                        return TextAreaField::create($item);
                    case getClassName(WysiwygField::class):
                        return WysiwygField::create($item);
                    default:
                        return null;
                }
            })
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
     * @return array
     */
    public function getLanguages(): array
    {
        return $this->languages;
    }

    /**
     * @return Collection
     */
    public function getFields(): Collection
    {
        return $this->fields;
    }
}