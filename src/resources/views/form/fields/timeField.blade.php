@extends('smoothy::form.fields.field', [
    'type' => 'timeField',
    'required' => $field->isRequired()
])

@section('field')

    <i class="fa fa-clock-o"></i>

    <input
        type="time"
        name="{{ $field->getName() }}"
        value="{{ old($field->getName()) }}"
        @if($field->hasPlaceholder(currentLocale())) placeholder="{{ $field->getPlaceholder(currentLocale()) }}" @endif
    >

@overwrite