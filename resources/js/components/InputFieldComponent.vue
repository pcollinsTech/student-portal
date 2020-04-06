<template>
    <div class="form-group row d-flex align-items-center">
        <!--Text / Email Field-->
        <template v-if="field.type == 'text' || field.type == 'email'">
            <label :for="field.id" class="col-md-5 col-form-label text-md-right">{{ field.name }} {{ fieldRequired(field.required) }} <br><small>{{ field.extra }}</small></label>

            <div class="col-md-6">
                <input :id="field.id" :type="field.type" class="form-control" :class="errorClass(field)" :name="field.id" v-model="field.value" :required="field.required" :autocomplete="field.autocomplete">

                <span v-if="field.error" class="invalid-feedback" role="alert">
                    <strong>{{ field.error }}</strong>
                </span>
            </div>
        </template>
        <!--Select Field-->
        <template v-else-if="field.type == 'select'">
            <label :for="field.id" class="col-md-5 col-form-label text-md-right">{{ field.name }} {{ fieldRequired(field.required) }} <br><small>{{ field.extra }}</small></label>

            <div class="col-md-6">
                <select :id="field.id" class="form-control" :class="errorClass(field)" :name="field.id" v-model="field.value" :required="field.required" :autocomplete="field.autocomplete">

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
                <vc-date-picker :class="errorClass(field)" v-model="field.value" :popover="{ placement: 'bottom', visibility: 'click' }" :is-required="true" :from-page="field.options[0].loadPage" :max-date="field.options[0].maxDate" :min-date="field.options[0].minDate"/>

                <span v-if="field.error" class="invalid-feedback" role="alert">
                    <strong>{{ field.error }}</strong>
                </span>
            </div>
        </template>
        <!--Textarea-->
        <template v-else-if="field.type == 'textarea'">
            <label :for="field.id" class="col-md-5 col-form-label text-md-right">{{ field.name }} {{ fieldRequired(field.required) }} <br><small>{{ field.extra }}</small></label>

            <div class="col-md-6">
                <textarea v-model="field.value" :name="field.id" :id="field.id" class="form-control" :class="errorClass(field)" :required="field.required"></textarea>

                <span v-if="field.error" class="invalid-feedback" role="alert">
                    <strong>{{ field.error }}</strong>
                </span>
            </div>
        </template>
        <!--True Detail-->
        <template v-else-if="field.type == 'true_detail'">
            <label :for="field.id" class="col-md-8 col-form-label text-md-right">{{ field.name }} <br><small v-if="field.extra">Viewable at the following <a :href="field.extra">link</a></small></label>

            <div class="col-md-4">
                <b-form-checkbox v-model="field.value" name="check-button" switch>
                    {{ niceBoolean }}
                </b-form-checkbox>

                <span v-if="field.error" class="invalid-feedback" role="alert">
                    <strong>{{ field.error }}</strong>
                </span>
            </div>

            <div class="col-md-12 mt-3" v-if="field.value">
                <input-field-component :field="field.options[Object.keys(field.options)[0]]" v-if="field.value"></input-field-component>
            </div>
        </template>
        <!--Boolean-->
        <template v-else-if="field.type == 'boolean'">
            <label :for="field.id" class="col-md-10 col-form-label text-md-right">{{ field.name }} <br><small v-if="field.extra">Viewable at the following <a :href="field.extra">link</a></small></label>

            <div class="col-md-2 text-right">
                <b-form-checkbox v-model="field.value" name="check-button" switch>
                    {{ niceBoolean }}
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
                <button @click="submit(field.id)" class="btn" :disabled="disabled" :class="field.value">{{ field.name }}</button>
            </div>
        </template>
        <!--Password-->
        <template v-else-if="field.type == 'password'">
            <label :for="field.id" class="col-md-5 col-form-label text-md-right">{{ field.name }} {{ fieldRequired(field.required) }} <br><small>{{ field.extra }}</small></label>

            <div class="col-md-6">
                <input :id="field.id" :type="field.type" class="form-control" :class="errorClass(field)" :name="field.id" v-model="field.value" :required="field.required" :autocomplete="field.autocomplete">

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
                <b-form-file v-model="field.value" :state="fieldStatus" placeholder="Choose a file..." drop-placeholder="Drop file here..." ></b-form-file>
                <span v-if="field.value" class="invalid-feedback text-dark d-block" role="alert">
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
<!--                <b-form-checkbox v-model="field.value" name="check-button" :options="field.options">-->
<!--                    {{ niceBoolean }}-->
<!--                </b-form-checkbox>-->

                <b-form-group>
                    <b-form-radio-group
                        :id="field.id"
                        v-model="field.value"
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
        <!--Repeater-->
        <template v-else-if="field.type == 'repeater'">
            <div class="col-md-12 mt-3" v-for="placement in repeaterNumberOfItems">
                <repeater-field-component v-for="(option, key) in field.options" :key="key" :repeaterKey="(placement - 1)" :field="option" ></repeater-field-component>
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

        watch: {
            field: {
                deep: true,

                handler(val) {
                    if(val.type == 'has_2_options') {
                        this.$emit(val.external, {
                            field: val.external,
                            value: val.value,
                        });
                    } else if(val.type == 'repeater') {
                        this.repeaterListenNumberOfItems = val.value;
                        // probably want a foreach here with each of the val.options
                        // and then the index in the [] will be val.value - 1
                        val.options.__placements__pharmacy.value[1] = '';
                    }
                },
            }
        },

        props: {
            field: {
                type: Object,
            },
        },

        data() {
            return {
                disabled: false,
                repeaterListenNumberOfItems: 1,
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
            repeaterNumberOfItems: function() {
                if(typeof this.field.external == 'string') {
                    return this.repeaterListenNumberOfItems;
                } else {
                    return 1;
                }
            },
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
            // agreeBoolean: function() {
            //     if(this.field.value) {
            //         return '<i class="fas fa-check"></i>';
            //     }
            //     return '';
            // }
        },
    }
</script>
