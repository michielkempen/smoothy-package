<template>
    <div :class="['form-field-input', error ? 'error' : '' ]">
        <i class="fa fa-envelope"></i>
        <input type="email" :name="name" :placeholder="field.placeholder">
    </div>
</template>

<script>
    export default {
        props: ['name', 'field', 'error']
    }
</script>
