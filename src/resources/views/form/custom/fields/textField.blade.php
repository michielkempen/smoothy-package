@extends('smoothy::form.formBuilder.fields.field', [
    'type' => 'textField',
    'required' => $field->isRequired()
])

@section('field')

    <i class="fa fa-font"></i>

    <input
        type="text"
        name="{{ $field->getName() }}"
        value="{{ old($field->getName()) }}"
        @if($field->hasPlaceholder()) placeholder="{{ $field->getPlaceholder(currentLocale()) }}" @endif
    >

@overwrite