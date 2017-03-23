<template>
    <div :class="['form-field-input', 'boolean-field', error ? 'error' : '' ]">
        <input type="checkbox" :name="name" value="1">
    </div>
</template>

<script>
    import Switchery from '../vendor/switchery';

    export default {
        props: ['name', 'field', 'error'],
        mounted() {
            this.$nextTick(() => {
                if(this.submittable) {
                    new Switchery($(this.$el).find('input[type=checkbox]')[0], {
                        color: '#d9001b',
                        secondaryColor: '#f5f5f5'
                    });
                }
            });
        }
    }
</script>
