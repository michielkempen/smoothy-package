@extends('smoothy::form.formBuilder.fields.field', [
    'type' => 'booleanField'
])

@section('field')

    <input
        type="checkbox"
        name="{{ $field->getName() }}"
        value="{{ old($field->getName()) }}"
    >

@overwrite