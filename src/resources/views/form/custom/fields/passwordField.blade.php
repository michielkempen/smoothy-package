@extends('smoothy::form.formBuilder.fields.field', [
    'type' => 'passwordField',
    'required' => $field->isRequired()
])

@section('field')

    <i class="fa fa-font"></i>

    <input
        type="password"
        name="{{ $field->getName() }}"
        value="{{ old($field->getName()) }}"
        @if($field->hasPlaceholder()) placeholder="{{ $field->getPlaceholder(currentLocale()) }}" @endif
    >

@overwrite