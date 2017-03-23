<?php

namespace Smoothy\Api\Responses\Transformers\Content\Types;

use Smoothy\Api\Responses\Models\Content\Types\Fields\BooleanField;
use Smoothy\Api\Responses\Models\Content\Types\Fields\FilesField;
use Smoothy\Api\Responses\Models\Content\Types\Fields\SelectField;
use Smoothy\Api\Responses\Models\Content\Types\Fields\TextAreaField;
use Smoothy\Api\Responses\Models\Content\Types\Fields\TextField;
use Smoothy\Models\Translation;

class TypeFieldTransformer
{
    /**
     * @param array $attributes
     * @return null
     */
    public function transform(array $attributes)
    {
        switch ($attributes['type']) {
            case class_basename(BooleanField::class):
                return $this->transformBooleanField($attributes);
            case class_basename(FilesField::class):
                return $this->transformFilesField($attributes);
            case class_basename(SelectField::class):
                return $this->transformSelectField($attributes);
            case class_basename(TextField::class):
                return $this->transformTextField($attributes);
            case class_basename(TextAreaField::class):
                return $this->transformTextAreaField($attributes);
            default:
                return null;
        }
    }

    /**
     * @param array $attributes
     * @return BooleanField
     */
    private function transformBooleanField(array $attributes)
    {
        return new BooleanField(
            $attributes['id'],
            new Translation($attributes['label']),
            new Translation($attributes['hint']),
            $attributes['required']
        );
    }

    /**
     * @param array $attributes
     * @return FilesField
     */
    private function transformFilesField(array $attributes)
    {
        return new FilesField(
            $attributes['id'],
            new Translation($attributes['label']),
            new Translation($attributes['hint']),
            $attributes['required'],
            $attributes['multiple'],
            $attributes['maximum_number'],
            collect($attributes['file_types'])
        );
    }

    /**
     * @param array $attributes
     * @return SelectField
     */
    private function transformSelectField(array $attributes)
    {
        return new SelectField(
            $attributes['id'],
            new Translation($attributes['label']),
            new Translation($attributes['hint']),
            $attributes['required'],
            $attributes['multiple'],
            collect($attributes['options'])
        );
    }

    /**
     * @param array $attributes
     * @return TextAreaField
     */
    private function transformTextAreaField(array $attributes)
    {
        return new TextAreaField(
            $attributes['id'],
            new Translation($attributes['label']),
            new Translation($attributes['placeholder']),
            new Translation($attributes['hint']),
            $attributes['required'],
            $attributes['translatable']
        );
    }

    /**
     * @param array $attributes
     * @return TextField
     */
    private function transformTextField(array $attributes)
    {
        return new TextField(
            $attributes['id'],
            new Translation($attributes['label']),
            new Translation($attributes['placeholder']),
            new Translation($attributes['hint']),
            $attributes['required'],
            $attributes['translatable']
        );
    }
}