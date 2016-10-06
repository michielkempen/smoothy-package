@extends('smoothy::form.formBuilder.fields.field', [
    'type' => 'percentageField',
    'required' => $field->isRequired()
])

@section('field')

    <i class="fa fa-percent"></i>

    <input
        type="number"
        min="0"
        max="100"
        name="{{ $field->getName() }}"
        value="{{ old($field->getName()) }}"
        @if($field->hasPlaceholder()) placeholder="{{ $field->getPlaceholder() }}" @endif
    >

@overwrite