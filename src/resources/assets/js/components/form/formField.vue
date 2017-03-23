<template>
    <div v-if="!(field.translatable && activeLanguages == 0)" class="form-field">
        <label :for="field.name" v-bind:class="{required: field.required}">
            {{ field.label }}
        </label>
        <div v-if="field.translatable">
            <div v-for="(active, language) in translations.languages" v-if="active" class="form-field-content">
                <div
                        v-if="Object.keys(translations.languages).length > 1"
                        class="language"
                        v-html="$t('languages.'+language)"
                ></div>
                <component
                        v-bind:is="field.type"
                        :field="field"
                        :name="field.name+'['+language+']'"
                        :error="errors.has(field.name+'.'+language)"
                ></component>
                <feedback
                        v-if="errors.has(field.name+'.'+language)"
                        :message="errors.get(field.name+'.'+language)"
                ></feedback>
            </div>
        </div>
        <div v-else>
            <div class="form-field-content">
                <component
                        v-bind:is="field.type"
                        :field="field"
                        :name="field.name"
                        :error="errors.has(field.name)"
                ></component>
                <feedback
                        v-if="errors.has(field.name)"
                        :message="errors.get(field.name)"
                ></feedback>
            </div>
        </div>
        <div class="hint" v-html="field.hint"></div>
    </div>
</template>

<script>
    import feedback from './feedback';

    import booleanField from './fields/booleanField';
    import colorField from './fields/colorField';
    import dateField from './fields/dateField';
    import dateTimeField from './fields/dateTimeField';
    import decimalField from './fields/decimalField';
    import emailField from './fields/emailField';
    import filesField from './fields/filesField';
    import integerField from './fields/integerField';
    import ipAddressField from './fields/ipAddressField';
    import percentageField from './fields/percentageField';
    import priceField from './fields/priceField';
    import selectField from './fields/selectField';
    import textAreaField from './fields/textAreaField';
    import textField from './fields/textField';
    import timeField from './fields/timeField';
    import urlField from './fields/urlField';

    export default {
        props: ['field', 'errors', 'translations'],
        components: {
            feedback,
            booleanField,
            colorField,
            dateField,
            dateTimeField,
            decimalField,
            emailField,
            filesField,
            integerField,
            ipAddressField,
            percentageField,
            priceField,
            selectField,
            textAreaField,
            textField,
            timeField,
            urlField
        },
        computed: {
            activeLanguages() {
                let counter = 0;
                for(let language in this.translations.languages) {
                    if(this.translations.languages[language])
                        counter++;
                }
                return counter;
            }
        }
    }
</script>
