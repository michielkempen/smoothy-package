<?php

namespace Smoothy\Api\Responses\Transformers\Custom\Forms;

use Carbon\Carbon;
use Smoothy\Api\Responses\Models\Custom\Forms\Fields\BooleanFormField;
use Smoothy\Api\Responses\Models\Custom\Forms\Fields\FilesFormField;
use Smoothy\Api\Responses\Models\Custom\Forms\Fields\SelectFormField;
use Smoothy\Api\Responses\Models\Custom\Forms\Fields\TextAreaFormField;
use Smoothy\Api\Responses\Models\Custom\Forms\Fields\TextFormField;
use Smoothy\Api\Responses\Models\Custom\Forms\Form;
use Smoothy\Api\Responses\Transformers\ModelTransformer;
use Smoothy\Models\Translation;

class FormTransformer extends ModelTransformer
{
    /**
     * @param array $attributes
     * @return Form
     */
    public function transform(array $attributes): Form
    {
        return new Form(
            $attributes['id'],
            new Translation($attributes['success_message']),
            collect($attributes['fields'])->map(function($field) {
                switch ($field['type']) {
                    case class_basename(BooleanFormField::class):
                        return $this->transformBooleanFormField($field);
                    case class_basename(FilesFormField::class):
                        return $this->transformFilesFormField($field);
                    case class_basename(SelectFormField::class):
                        return $this->transformSelectFormField($field);
                    case class_basename(TextFormField::class):
                        return $this->transformTextFormField($field);
                    case class_basename(TextAreaFormField::class):
                        return $this->transformTextAreaFormField($field);
                    default:
                        return null;
                }
            }),
            isset($attributes['published_from']['date'])
                ? Carbon::parse($attributes['published_from']['date'])
                : null,
            isset($attributes['published_until']['date'])
                ? Carbon::parse($attributes['published_until']['date'])
                : null
        );
    }

    /**
     * @param array $field
     * @return BooleanFormField
     */
    private function transformBooleanFormField(array $field)
    {
        return new BooleanFormField(
            $field['id'],
            $field['form_id'],
            new Translation($field['label']),
            new Translation($field['hint']),
            $field['required']
        );
    }

    /**
     * @param array $field
     * @return FilesFormField
     */
    private function transformFilesFormField(array $field)
    {
        return new FilesFormField(
            $field['id'],
            $field['form_id'],
            new Translation($field['label']),
            new Translation($field['hint']),
            $field['required'],
            $field['multiple'],
            collect($field['file_types'])
        );
    }

    /**
     * @param array $field
     * @return SelectFormField
     */
    private function transformSelectFormField(array $field)
    {
        return new SelectFormField(
            $field['id'],
            $field['form_id'],
            new Translation($field['label']),
            new Translation($field['hint']),
            $field['required'],
            collect($field['options'])
        );
    }

    /**
     * @param array $field
     * @return TextAreaFormField
     */
    private function transformTextAreaFormField(array $field)
    {
        return new TextAreaFormField(
            $field['id'],
            $field['form_id'],
            new Translation($field['label']),
            new Translation($field['placeholder']),
            new Translation($field['hint']),
            $field['required']
        );
    }

    /**
     * @param array $field
     * @return TextFormField
     */
    private function transformTextFormField(array $field)
    {
        return new TextFormField(
            $field['id'],
            $field['form_id'],
            new Translation($field['label']),
            new Translation($field['placeholder']),
            new Translation($field['hint']),
            $field['required']
        );
    }
}