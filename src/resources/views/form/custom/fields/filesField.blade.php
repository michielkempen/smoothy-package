@extends('smoothy::form.formBuilder.fields.field', [
    'type' => 'filesField',
    'required' => $field->isRequired()
])

@section('field')

    <input type="file" name="{{ $field->getName() }}" value="{{ old($field->getName()) }}">

@overwrite