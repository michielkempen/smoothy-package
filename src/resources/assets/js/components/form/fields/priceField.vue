<template>
    <div :class="['form-field-input', error ? 'error' : '' ]">
        <i class="fa fa-money"></i>
        <input type="text" :name="name" :placeholder="field.placeholder">
    </div>
</template>

<script>
    export default {
        props: ['name', 'field', 'error']
    }
</script>
