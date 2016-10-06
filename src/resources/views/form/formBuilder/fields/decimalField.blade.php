@extends('smoothy::form.formBuilder.fields.field', [
    'type' => 'decimalField',
    'required' => $field->isRequired()
])

@section('field')

    <i class="fa fa-calculator"></i>

    <input
        type="number"
        step="any"
        name="{{ $field->getName() }}"
        value="{{ old($field->getName()) }}"
        @if($field->hasPlaceholder()) placeholder="{{ $field->getPlaceholder() }}" @endif
    >

@overwrite