@extends('smoothy::form.formBuilder.fields.field', [
    'type' => 'colorField',
    'required' => $field->isRequired()
])

@section('field')

    <i class="fa fa-eyedropper"></i>

    <input
        type="color"
        name="{{ $field->getName() }}"
        value="{{ old($field->getName()) }}"
        @if($field->hasPlaceholder()) placeholder="{{ $field->getPlaceholder() }}" @endif
    >

@overwrite