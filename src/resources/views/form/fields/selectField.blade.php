@extends('smoothy::form.fields.field', [
    'type' => 'selectField',
    'required' => $field->isRequired()
])

@section('field')

    <i class="fa fa-mouse-pointer"></i>

    <select
        data-placeholder="{{ trans('smoothy::form.selectPlaceholder') }}"
        name="{{ $field->getName() }}"
        value="{{ old($field->getName()) }}"
        @if($field->isMultiple())
            multiple
        @else
            data-allow-clear="true"
        @endif
    >
        @foreach($field->getOptions() as $option)
            <option value="{{ $option }}">
                {{ $option }}
            </option>
        @endforeach
    </select>

    <i class="fa fa-angle-down"></i>

@overwrite