@extends('smoothy::form.fields.field', [
    'type' => 'dateField',
    'required' => $field->isRequired()
])

@section('field')

    <i class="fa fa-calendar"></i>

    <input
        type="date"
        name="{{ $field->getName() }}"
        value="{{ old($field->getName()) }}"
        @if($field->hasPlaceholder(currentLocale())) placeholder="{{ $field->getPlaceholder(currentLocale()) }}" @endif
    >

@overwrite