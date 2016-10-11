@extends('smoothy::form.fields.field', [
    'type' => 'booleanField'
])

@section('field')

    <input type="hidden" name="{{ $field->getName() }}" value="0">
    <input type="checkbox" class="js-switch" name="{{ $field->getName() }}" value="{{ old($field->getName()) }}">

@overwrite