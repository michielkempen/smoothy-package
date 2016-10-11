<div class="field {{ $type }} @if(isset($full)) full @endif">

    <label
        for="{{ $field->getName() }}"
        @if(isset($required) && $required) class="required" @endif
    >
        {{ $field->getLabel(currentLocale()) }}
    </label>

    <div class="formField @if($field->hasHint()) tip @endif">

        @yield('field')

        @include('smoothy::form.feedback', compact('field'))

    </div>

</div>