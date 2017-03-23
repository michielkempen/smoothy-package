<template>
    <form enctype="multipart/form-data" v-on:submit.prevent="submit">
        <div v-if="message == null" class="form-field-groups">
            <fieldset v-for="fieldGroup in form.field_groups" class="form-field-group">
                <legend>{{ fieldGroup.heading }}</legend>
                <p v-if="fieldGroup.description != ''" v-html="fieldGroup.description"></p>
                <div class="form-field-group-fields">
                    <form-field v-for="field in fieldGroup.fields" :field="field" :errors="errors" :translations="translations"></form-field>
                </div>
            </fieldset>
        </div>
        <div v-else class="form-message">
            <p v-html="message"></p>
        </div>
        <div v-if="message == null" class="form-controls">
            <div class="form-control-button">
                <div v-if="submitting">
                    <loader :white="true"></loader>
                </div>
                <button v-else type="submit">{{ buttonLabel }}</button>
            </div>
        </div>
    </form>
</template>

<script>
    import manipulatedImage from '../image'
    import formField from './formField'
    import loader from '../loader'
    import Errors from './Errors'

    export default {
        props: ['form'],
        components: {
            manipulatedImage,
            formField,
            loader
        },
        data() {
            return {
                submitting: false,
                message: null,
                translations: {
                    languages: {
                        nl: true
                    }
                },
                buttonLabel: 'verzenden',
                errors: new Errors()
            }
        },
        methods: {

            submit() {
                this.submitting = true;

                let data = new FormData();
                $(this.$el).find(':input').each(function() {
                    if($(this).is('input:file')) {
                        data.append(this.name, this.files[0]);
                    } else if($(this).is('input:checkbox')) {
                        data.append(this.name, $(this).is(':checked') ? 1 : null);
                    } else if($(this).is('select')) {
                        data.append(this.name, JSON.stringify($(this).val()));
                    } else {
                        data.append(this.name, $(this).val());
                    }
                });

                axios.post('', data).then(response => {
                    this.message = this.form.notification == null
                        ? 'We hebben uw inzending succesvol ontvangen.'
                        : this.form.notification;
                    this.submitting = false;
                }).catch(error => {
                    this.errors.record(error.response.data.errors);
                    this.submitting = false;
                });
            }
        }
    }
</script>
