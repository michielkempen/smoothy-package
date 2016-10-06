@extends('smoothy::form.formBuilder.fields.field', [
    'type' => 'timeField',
    'required' => $field->isRequired()
])

@section('field')

    <i class="fa fa-clock-o"></i>

    <input
        type="time"
        name="{{ $field->getName() }}"
        value="{{ old($field->getName()) }}" @if($field->hasPlaceholder())
        placeholder="{{ $field->getPlaceholder() }}" @endif
    >

@overwrite