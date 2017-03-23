<template>
    <div :class="['form-field-input', 'files-field', error ? 'error' : '' ]">
        <i class="fa fa-file"></i>

        <input
            type="file"
            :name="name"
            :accept="field.file_types"
        >
    </div>
</template>

<script>
    export default{
        props: ['name', 'field', 'error'],
        data() {
            return {
                file_count: 0
            }
        },
        mounted() {
            this.$nextTick(() => {
                this.initialize();
            });
        },
        methods: {
            initialize() {
                var input = $(this.$el).find('input[type="file"]');
                var label = input.next('label');
                var labelVal = label.html();

                input.on('change', function(e) {
                    var fileName = '';

                    if(this.files && this.files.length > 1)
                        fileName = (this.getAttribute('data-multiple-caption') || '').replace(':count', ''+this.files.length);
                    else if(e.target.value)
                        fileName = e.target.value.split('\\').pop();

                    if(fileName)
                        label.html(fileName);
                    else
                        label.html(labelVal);
                });
            }
        }
    }
</script>
