<template>
    <div :class="['form-field-input', 'select-field', error ? 'error' : '' ]">
        <i class="fa fa-mouse-pointer"></i>
        <select v-if="field.multiple" :name="name" multiple>
            <option v-for="(option, key) in field.options" :value="key">
                {{ option }}
            </option>
        </select>
        <select v-else :name="name">
            <option v-if="!field.required" value=""></option>
            <option v-for="(option, key) in field.options" :value="key">
                {{ option }}
            </option>
        </select>
    </div>
</template>

<script>
    require('select2');

    export default {
        props: ['name', 'field', 'error'],
        mounted() {
            $(this.$el).find('select').select2({
                allowClear: true,
                placeholder: ''
            });
        }
    }
</script>
