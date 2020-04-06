<template>
    <div class="form-group row d-flex align-items-center">
        <!--Text / Email Field-->
        <template v-if="field.type == 'text' || field.type == 'email'">
            <label :for="field.id" class="col-md-5 col-form-label text-md-right">{{ field.name }} {{ fieldRequired(field.required) }} <br><small>{{ field.extra }}</small></label>

            <div class="col-md-6">
                <input :id="field.id" :type="field.type" class="form-control" :class="errorClass(field)" :name="field.id" v-model="field.value[repeaterKey]" :required="field.required" :autocomplete="field.autocomplete">

                <span v-if="field.error" class="invalid-feedback" role="alert">
                    <strong>{{ field.error }}</strong>
                </span>
            </div>
        </template>
        <!--Select Field-->
        <template v-else-if="field.type == 'select'">
            <label :for="field.id" class="col-md-5 col-form-label text-md-right">{{ field.name }} {{ fieldRequired(field.required) }} <br><small>{{ field.extra }}</small></label>

            <div class="col-md-6">
                <select :id="field.id" class="form-control" :class="errorClass(field)" :name="field.id" v-model="field.value[repeaterKey]" :required="field.required" :autocomplete="field.autocomplete">

                    <option v-if="!field.external" v-for="option in field.options" :disabled="option.disabled" :value="option.value">{{ option.display }}</option>
                    <option v-else v-for="option in getVariable(field.external)" :disabled="option.disabled" :value="option.value">{{ option.display }}</option>

                </select>

                <span v-if="field.error" class="invalid-feedback" role="alert">
                    <strong>{{ field.error }}</strong>
                </span>
            </div>
        </template>
        <!--Date Field-->
        <template v-else-if="field.type == 'date'">
            <label :for="field.id" class="col-md-5 col-form-label text-md-right">{{ field.name }} {{ fieldRequired(field.required) }} <br><small>{{ field.extra }}</small></label>

            <div class="col-md-6">
                <vc-date-picker :class="errorClass(field)" v-model="field.value[repeaterKey]" :popover="{ placement: 'bottom', visibility: 'click' }" :is-required="true" :from-page="field.options[repeaterKey].loadPage" :max-date="field.options[repeaterKey].maxDate" :min-date="field.options[repeaterKey].minDate"/>

                <span v-if="field.error" class="invalid-feedback" role="alert">
                    <strong>{{ field.error }}</strong>
                </span>
            </div>
        </template>
        <!--Textarea-->
        <template v-else-if="field.type == 'textarea'">
            <label :for="field.id" class="col-md-5 col-form-label text-md-right">{{ field.name }} {{ fieldRequired(field.required) }} <br><small>{{ field.extra }}</small></label>

            <div class="col-md-6">
                <textarea v-model="field.value[repeaterKey]" :name="field.id" :id="field.id" class="form-control" :class="errorClass(field)" :required="field.required"></textarea>

                <span v-if="field.error" class="invalid-feedback" role="alert">
                    <strong>{{ field.error }}</strong>
                </span>
            </div>
        </template>
        <!--True Detail-->
        <template v-else-if="field.type == 'true_detail'">
            <label :for="field.id" class="col-md-8 col-form-label text-md-right">{{ field.name }} <br><small v-if="field.extra">Viewable at the following <a :href="field.extra">link</a></small></label>

            <div class="col-md-4">
                <b-form-checkbox v-model="field.value[repeaterKey]" name="check-button" switch>
                    {{ niceBoolean }}
                </b-form-checkbox>

                <span v-if="field.error" class="invalid-feedback" role="alert">
                    <strong>{{ field.error }}</strong>
                </span>
            </div>

            <div class="col-md-12 mt-3" v-if="field.value[repeaterKey]">
                <input-field-component :field="field.options[Object.keys(field.options)[0]]" v-if="field.value[repeaterKey]"></input-field-component>
            </div>
        </template>
        <!--Boolean-->
        <template v-else-if="field.type == 'boolean'">
            <label :for="field.id" class="col-md-11 col-form-label text-md-right">{{ field.name }} <br><small v-if="field.extra">Viewable at the following <a :href="field.extra">link</a></small></label>

            <div class="col-md-1 text-right">
                <b-form-checkbox v-model="field.value[repeaterKey]" name="check-button" switch>
                    <!--                    <span v-html="agreeBoolean"></span>-->
                </b-form-checkbox>
            </div>
            <div v-if="field.error" class="col-md-11 text-md-right">
                <span class="invalid-feedback d-block mt-0" role="alert">
                    <strong>{{ field.error }}</strong>
                </span>
            </div>
        </template>
        <!--Submit-->
        <template v-else-if="field.type == 'submit'">
            <div class="col-md-12 text-right">
                <button @click="submit(field.id)" class="btn" :disabled="disabled" :class="field.value[repeaterKey]">{{ field.name }}</button>
            </div>
        </template>
        <!--Password-->
        <template v-else-if="field.type == 'password'">
            <label :for="field.id" class="col-md-5 col-form-label text-md-right">{{ field.name }} {{ fieldRequired(field.required) }} <br><small>{{ field.extra }}</small></label>

            <div class="col-md-6">
                <input :id="field.id" :type="field.type" class="form-control" :class="errorClass(field)" :name="field.id" v-model="field.value[repeaterKey]" :required="field.required" :autocomplete="field.autocomplete">

                <span v-if="field.error" class="invalid-feedback" role="alert">
                    <strong>{{ field.error }}</strong>
                </span>
            </div>
        </template>
        <!--Plaintext-->
        <template v-else-if="field.type == 'plaintext'">
            <label class="col-md-12 col-form-label text-md-right">{{ field.name }}</label>
            <label class="col-md-12 col-form-label text-md-right">
                <strong>{{ field.extra }}</strong>
            </label>
        </template>
        <!--File Upload-->
        <template v-else-if="field.type == 'file_upload'">
            <label :for="field.id" class="col-md-5 col-form-label text-md-right">{{ field.name }} {{ fieldRequired(field.required) }} <br><small>{{ field.extra }}</small></label>

            <div class="col-md-7 align-self-start pt-2_5">
                <!-- Styled -->
                <b-form-file v-model="field.value[repeaterKey]" :state="fieldStatus" placeholder="Choose a file..." drop-placeholder="Drop file here..." ></b-form-file>
                <span v-if="field.value[repeaterKey]" class="invalid-feedback text-dark d-block" role="alert">
                    <strong class="text-dark">{{ field.value.name }}</strong>
                </span>
                <span v-if="field.error" class="invalid-feedback" role="alert">
                    <strong>{{ field.error }}</strong>
                </span>
            </div>
        </template>
        <!--Has 2 Options-->
        <template v-else-if="field.type == 'has_2_options'">
            <label :for="field.id" class="col-md-5 col-form-label text-md-right">{{ field.name }} {{ fieldRequired(field.required) }} <br><small>{{ field.extra }}</small></label>

            <div class="col-md-7 text-right">
                <b-form-group>
                    <b-form-radio-group
                        :id="field.id"
                        v-model="field.value[repeaterKey]"
                        :options="field.options"
                        buttons
                        button-variant="outline-primary"
                        :name="field.id"
                    ></b-form-radio-group>
                </b-form-group>
            </div>
            <div v-if="field.error" class="col-md-11 text-md-right">
                <span class="invalid-feedback d-block mt-0" role="alert">
                    <strong>{{ field.error }}</strong>
                </span>
            </div>
        </template>
        <!--Repeater not available inside repeater-->
        <template v-else-if="field.type == 'repeater'">
            <div class="col-12">
                <div class="alert alert-danger mb-0" role="alert">
                    <strong>Not Available: </strong>{{ field.name }}
                </div>
            </div>
        </template>
        <!--Todo-->
        <template v-else-if="field.type == 'todo'">
            <div class="col-12">
                <div class="alert alert-danger mb-0" role="alert">
                    <strong>Todo: </strong>{{ field.name }}
                </div>
            </div>
        </template>
        <!--Other-->
        <template v-else>
            <div class="col-12">
                <div class="alert alert-danger mb-0" role="alert">
                    Field of type: <strong>{{ field.type }}</strong> not defined
                </div>
            </div>
        </template>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.$parent.$on('disabled', (fieldId) => {

                if(fieldId == this.field.id) {
                    this.disabled = true;
                }

            });

            this.$parent.$on('enabled', (fieldId) => {

                if(fieldId == this.field.id) {
                    this.disabled = false;
                }

            });
        },

        props: {
            field: {
                type: Object,
            },
            repeaterKey: {
                type: Number,
                required: true,
            }
        },

        data() {
            return {
                disabled: false,
            };
        },

        methods: {
            submit(fieldId) {
                this.$emit('submit', fieldId);
            },

            fieldRequired(isRequired) {
                if(isRequired) {
                    return '*';
                }
                return '';
            },

            errorClass(field) {
                // If error return is-invalid.
                if(field.error) {
                    return 'is-invalid';
                }

                // Return no class.
                return '';
            }
        },

        computed: {
            niceBoolean: function() {
                if(this.field.value) {
                    return 'Yes';
                }
                return 'No';
            },
            fieldStatus: function() {
                if(this.field.error) {
                    return false;
                }
                return null;
            }
        },
    }
</script>
