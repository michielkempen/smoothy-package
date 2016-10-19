@extends('smoothy::form.fields.field', [
    'type' => 'emailField',
    'required' => $field->isRequired()
])

@section('field')

    <i class="fa fa-envelope"></i>

    <input
        type="email"
        name="{{ $field->getName() }}"
        value="{{ old($field->getName()) }}"
        @if($field->hasPlaceholder(currentLocale())) placeholder="{{ $field->getPlaceholder(currentLocale()) }}" @endif
    >

@overwrite