<template>
    <div :class="['form-field-input', 'text-area-field', error ? 'error' : '' ]">
        <textarea :name="name" :placeholder="field.placeholder" :rows="5"></textarea>
    </div>
</template>

<script>
    export default {
        props: ['name', 'field', 'error']
    }
</script>
