<div class="form">

    @foreach($form->getFields() as $field)

        @include($field->getView(), compact('field'))

    @endforeach

</div>