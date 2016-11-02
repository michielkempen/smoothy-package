@extends('smoothy::form.fields.field', [
    'type' => 'booleanField'
])

@section('field')

    {!! Form::checkbox($field->getName(), 1, false, ['class' => 'js-switch']) !!}

@overwrite