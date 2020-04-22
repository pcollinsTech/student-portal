<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Character Declaration</div>
                    <div class="card-body">
                        <p class="text-right">Click on buttons to confirm.</p>
                        <p>* represents required fields</p>
                        <p>It is important that any graduate wishing to register as a trainee of the Pharmaceutical Society NI must be able to satisfy the Council of the Pharmaceutical Society of his/her good character.</p>
                        <br/>
                        <template v-for="field in fields_0">
                            <input-field-component @submit="eventHandler($event)" :field="field"></input-field-component>
                        </template>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6"><a href="/back"><button class="btn btn-info">Back</button></a></div>
            <div class="col-sm-6 text-right"><a href="/forward"><button class="btn btn-info">Forward</button></a></div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        mounted() {
            console.log('Component mounted.')
        },

        props: {
             initialData: {
                type:Object
            }
            // counties: {
            //     type: Array,
            //     required: true,
            // },
            // universities: {
            //     type: Array,
            //     required: true,
            // },
        },

        data() {
            return {
                fields_0: {
                   character_declaration_1: {
                        id: 'character_declaration_1',
                        name: 'Have you been subject to any sanction under student Fitness to Practise procedures whilst studying at university? Further guidance about what is considered a sanction can be found at:',
                        extra: 'https://www.pharmacyregulation.org/sites/default/files/document/guidance_on_student_fitness_to_practise_procedures_in_schools_of_pharmacy_july_2018_.pdf',
                        type: 'true_detail', // if true, show detail
                        autocomplete: 'off',
                        error: false,
                        options: {
                            __character_declaration_1__details: {
                                id: '__character_declaration_1__details',
                                name: 'Provide any evidence that would help support your claim of good character for consideration by the registrar if not previously supplied.',
                                extra: '',
                                type: 'textarea',
                                autocomplete: 'off',
                                error: false,
                                options: [],
                                external: false,
                                value: this.initialData.character_declaration_details.character_declaration_1 ? this.initialData.character_declaration_details.character_declaration_1 : null,
                                required: false
                            }
                        },
                        external: false,
                        value: this.initialData.character_declarations.character_declaration_1 ? this.initialData.character_declarations.character_declaration_1 : null,
                        required: false,
                    },
                    character_declaration_2: {
                        id: 'character_declaration_2',
                        name: 'Are you currently bound over or do you have any convictions, cautions or informed warnings in the UK or in any other country which are not deemed \'protected\' under the Rehabilitation of Offenders (Exceptions) Order (NI) 1979 (as amended in 2014) or are not subject to \'filtering\' under tge Police Act 1997 (as amended)? Guidance on \'protected\' convictions and the \'filtering\' scheme can be found at:',
                        extra: 'https://www.nidirect.gov.uk/articles/information-disclosed-in-a-criminal-record-check#toc-2',
                        type: 'true_detail', // if true, show detail
                        autocomplete: 'off',
                        error: false,
                        options: {
                            __character_declaration_2__details: {
                                id: '__character_declaration_2__details',
                                name: 'Provide any evidence that would help support your claim of good character for consideration by the registrar if not previously supplied.',
                                extra: '',
                                type: 'textarea',
                                autocomplete: 'off',
                                error: false,
                                options: [],
                                external: false,
                                value: this.initialData.character_declaration_details.character_declaration_2 ? this.initialData.character_declaration_details.character_declaration_2 : null,
                                required: false,
                            }
                        },
                        external: false,
                        value: this.initialData.character_declarations.character_declaration_2 ? this.initialData.character_declarations.character_declaration_2 : null,
                        required: false,
                    },
                    character_declaration_3: {
                        id: 'character_declaration_3',
                        name: 'Are you the subject of ongoing or pending criminal proceedings in the UK or elsewhere (other than a motoring offence not likely to result in a disqualification), about which you have not previously advised the registrar in writing?',
                        extra: '',
                        type: 'true_detail', // if true, show detail
                        autocomplete: 'off',
                        error: false,
                        options: {
                            __character_declaration_3__details: {
                                id: '__character_declaration_3__details',
                                name: 'Provide any evidence that would help support your claim of good character for consideration by the registrar if not previously supplied.',
                                extra: '',
                                type: 'textarea',
                                autocomplete: 'off',
                                error: false,
                                options: [],
                                external: false,
                                value: this.initialData.character_declaration_details.character_declaration_3 ? this.initialData.character_declaration_details.character_declaration_3 : null,
                                required: false,
                            }
                        },
                        external: false,
                        value: this.initialData.character_declarations.character_declaration_3 ? this.initialData.character_declarations.character_declaration_3 : null,
                        required: false,
                    },
                    character_declaration_4: {
                        id: 'character_declaration_4',
                        name: 'Have you agreed to pay a penalty under Section 109a of the Social Security Administration (Northern Ireland) Order 1992 (penalty as an alternative to prosecution) about which you have not previosuly advised the registrar in writing?',
                        extra: '',
                        type: 'true_detail', // if true, show detail
                        autocomplete: 'off',
                        error: false,
                        options: {
                            __character_declaration_4__details: {
                                id: '__character_declaration_4__details',
                                name: 'Provide any evidence that would help support your claim of good character for consideration by the registrar if not previously supplied.',
                                extra: '',
                                type: 'textarea',
                                autocomplete: 'off',
                                error: false,
                                options: [],
                                external: false,
                                value: this.initialData.character_declaration_details.character_declaration_4 ? this.initialData.character_declaration_details.character_declaration_4 : null,
                                required: false,
                            }
                        },
                        external: false,
                        value: this.initialData.character_declarations.character_declaration_4 ? this.initialData.character_declarations.character_declaration_4 : null,
                        required: false,
                    },
                    character_declaration_5: {
                        id: 'character_declaration_5',
                        name: 'Have you been notified by a regulatory body in the UK responsible under any statutory provision for the regulation of a health or social care profession of a determination to the effect that your fitness to practise is impaired, or a determination by a regulatory body elsewhere to the same effect, about which you have not previously advised the registrar in writing?',
                        extra: '',
                        type: 'true_detail', // if true, show detail
                        autocomplete: 'off',
                        error: false,
                        options: {
                            __character_declaration_5__details: {
                                id: '__character_declaration_5__details',
                                name: 'Provide any evidence that would help support your claim of good character for consideration by the registrar if not previously supplied.',
                                extra: '',
                                type: 'textarea',
                                autocomplete: 'off',
                                error: false,
                                options: [],
                                external: false,
                                value: this.initialData.character_declaration_details.character_declaration_5 ? this.initialData.character_declaration_details.character_declaration_5 : null,
                                required: false,
                            }
                        },
                        external: false,
                        value: this.initialData.character_declarations.character_declaration_5 ? this.initialData.character_declarations.character_declaration_5 : null,
                        required: false,
                    },
                    character_declaration_6: {
                        id: 'character_declaration_6',
                        name: 'Are you subject to an investigation by another regulatory body (other than the PSNI) about which you have not previously advised the registrar in writing?',
                        extra: '',
                        type: 'true_detail', // if true, show detail
                        autocomplete: 'off',
                        error: false,
                        options: {
                            __character_declaration_6__details: {
                                id: '__character_declaration_6__details',
                                name: 'Provide any evidence that would help support your claim of good character for consideration by the registrar if not previously supplied.',
                                extra: '',
                                type: 'textarea',
                                autocomplete: 'off',
                                error: false,
                                options: [],
                                external: false,
                                value: this.initialData.character_declaration_details.character_declaration_6 ? this.initialData.character_declaration_details.character_declaration_6 : null,
                                required: false,
                            }
                        },
                        external: false,
                        value: this.initialData.character_declarations.character_declaration_6 ? this.initialData.character_declarations.character_declaration_6 : null,
                        required: false,
                    },
                    character_declaration_7: {
                        id: 'character_declaration_7',
                        name: 'Are you the subject of any fraud investigation by an HSC body about whih you have not previously advised the registrar in writing?',
                        extra: '',
                        type: 'true_detail', // if true, show detail
                        autocomplete: 'off',
                        error: false,
                        options: {
                            __character_declaration_7__details: {
                                id: '__character_declaration_7__details',
                                name: 'Provide any evidence that would help support your claim of good character for consideration by the registrar if not previously supplied.',
                                extra: '',
                                type: 'textarea',
                                autocomplete: 'off',
                                error: false,
                                options: [],
                                external: false,
                                value: this.initialData.character_declaration_details.character_declaration_7 ? this.initialData.character_declaration_details.character_declaration_7 : null,
                                required: false,
                            }
                        },
                        external: false,
                        value: this.initialData.character_declarations.character_declaration_7 ? this.initialData.character_declarations.character_declaration_7 : null,
                        required: false,
                    },
                    character_declaration_8: {
                        id: 'character_declaration_8',
                        name: 'Are you included in a barred list (within the meaning of the Safeguarding Vulnerable Groups Act 2006 or the Safeguarding Vulnerable Groups (Northern Ireland) Order 2007) about which you have not previously advised the registrar in writing?',
                        extra: '',
                        type: 'true_detail', // if true, show detail
                        autocomplete: 'off',
                        error: false,
                        options: {
                            __character_declaration_8__details: {
                                id: '__character_declaration_8__details',
                                name: 'Provide any evidence that would help support your claim of good character for consideration by the registrar if not previously supplied.',
                                extra: '',
                                type: 'textarea',
                                autocomplete: 'off',
                                error: false,
                                options: [],
                                external: false,
                                value: this.initialData.character_declaration_details.character_declaration_8 ? this.initialData.character_declaration_details.character_declaration_8 : null,
                                required: false,
                            }
                        },
                        external: false,
                        value: this.initialData.character_declarations.character_declaration_8 ? this.initialData.character_declarations.character_declaration_8 : null,
                        required: false,
                    },
                    character_declaration_9: {
                        id: 'character_declaration_9',
                        name: 'I declare that the information provided above is true. I know of NO REASON that might result in me being considered an unsuitable  person to undertake pre-registration training.',
                        extra: '',
                        type: 'boolean',
                        autocomplete: 'off',
                        error: false,
                        options: [],
                        external: false,
                        value:this.initialData.character_declarations.character_declaration_9 ? this.initialData.character_declarations.character_declaration_9 : null,
                        required: true,
                    },
                    submit_step_3: {
                        id: 'submit_step_3',
                        name: 'Proceed to Next Step',
                        extra: '',
                        type: 'submit',
                        autocomplete: 'off',
                        error: false,
                        options: [],
                        external: false,
                        value: 'btn-primary', // when submit this is the class field
                        required: true,
                    },
                },
            }
        },

        methods: {
            eventHandler(fieldId) {
                switch(fieldId) {
                    case 'submit_step_3':

                        // disable the button which was clicked
                        this.$emit('disabled', fieldId);

                        // submit the form
                        this.submitForm(fieldId);
                        break;

                    default:
                        // do nothing if not defined
                        break;
                }
            },

            submitForm(submitTrigger) {

                // Clear all Errors

                var formData = new FormData();

                formData.append('currentStep', 'character_declaration');

                for (const field in this.fields_0) {
                    formData.append([this.fields_0[field].id], this.fields_0[field].value);
                    this.fields_0[field].error = false;

                    if (this.fields_0[field].type == 'true_detail') {
                        let subOption = this.fields_0[field].options[Object.keys(this.fields_0[field].options)[0]];
                        formData.append([subOption.id], subOption.value);
                        subOption.error = false;
                    }
                }

                // submit form here
                var self = this;

                axios.post('/registration', formData)
                    .then(function (response) {

                        // Proceed to next step
                        // console.log(response);

                        // Redirect to the Registration Payment
                        window.location.replace("/registration");

                    })
                    .catch(function (error) {

                        // Set Error Messages
                        for(const currentError in error.response.data.errors) {
                            if(self.fields_0.hasOwnProperty(currentError)) {
                                self.fields_0[currentError].error = error.response.data.errors[currentError][0];
                            } else {
                                console.log(currentError);
                                let subError = currentError.split('__')[1];
                                console.log(subError[1]);

                                if(self.fields_0.hasOwnProperty(subError)) {
                                    self.fields_0[subError].options[currentError].error = error.response.data.errors[currentError][0];
                                }

                            }
                        }

                        // Scroll to top of page smoothly
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });

                        // Re-enable the form
                        self.$emit('enabled', submitTrigger);

                    });

            },
        },

        computed: {
            countyOptions: function() {

            }
        },
    }
</script>
