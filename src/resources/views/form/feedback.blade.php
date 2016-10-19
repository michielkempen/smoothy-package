<div class="feedback">
    <div class="icon"></div>
    <div class="message">
        @if($field->hasHint(currentLocale()))
            <div class="tip-message">{{ $field->getHint(currentLocale()) }}</div>
        @endif
        <div class="error-message"></div>
    </div>
</div>