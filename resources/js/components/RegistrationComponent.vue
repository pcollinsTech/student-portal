<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Personal Details</div>

                    <div class="card-body">
                        <template v-for="field in fields_0">
                            <input-field-component @submit="eventHandler($event)" :field="field"></input-field-component>
                        </template>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">Address</div>

                    <div class="card-body">
                        <template v-for="field in fields_1">
                            <input-field-component @submit="eventHandler($event)" :field="field"></input-field-component>
                        </template>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">Education</div>

                    <div class="card-body">
                        <template v-for="field in fields_2">
                            <input-field-component @submit="eventHandler($event)" :field="field"></input-field-component>
                        </template>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">Declarations</div>

                    <div class="card-body">
                        <template v-for="field in fields_3">
                            <input-field-component @submit="eventHandler($event)" :field="field"></input-field-component>
                        </template>
                        <hr/>
                        <p>
                            The Pharmaceutical Society NI (PSNI) is a data controller registered with the Information Commissioner’s Office. We will make use of personal data provided to support our work in administering pre-registration training, as the regulatory body for Pharmacists and registered Pharmacies in Northern Ireland and for our work as the professional leadership body for Pharmacists in Northern Ireland. We will process your personal data for purposes including updating the trainee register, administering pre-registration training, registration, processing complaints, monitoring fitness to practise, and compiling statistics.
                        </p>
                        <p>
                            PSNI will not share your personal data on a commercial basis with any third party. We may, however, share your data with third parties to meet our statutory aims, objectives, powers and responsibilities under the Pharmacy (Northern Ireland) Order 1976, the regulations made under the Order and other legislation. We may pass information to organisations with a legitimate interest including other regulatory and enforcement authorities, Health and Social Care Board, Business Service Organisation, employers and the DoH.
                        </p>
                        <p>
                            Your data is processed under General Data Protection Regulation (GDPR) Article 6 (c)(d)(e)(f).
                        </p>
                        <p>
                            Your name, address, date of birth, telephone numbers, email address, employment details are used for the administration of the pre-registration training programme, finance and regulatory processing. These details are held securely in paper and digital form. By completing the pre-registration application process, you agree to PSNI holding and processing these details under the GDPR regulations.
                        </p>
                        <p>
                            Employment data can also be used to develop regulatory activities and services in relation to the workforce. This information, as a statistic, may be made publicly available.
                        </p>
                        <p>
                            Your personal details are used by departments dealing with pre-registration training, administration and communication to provide up to date information about pre-registration training, regulatory activities and by the Pharmacy Forum for the purpose of communications in relation to pre-registration training activities. This can be sent by postal mail or email and, under GDPR regulations, are sent under legitimate interests.
                        </p>
                        <p>
                            Declarations of health or character will be primarily processed by the Registrar and other members of the organisation for regulatory activities.
                        </p>
                        <p>
                            This information can be used in conjunction with FtP processes and can, where appropriate, be shared with relevant governing bodies. These are stored securely, in paper and digital form, separately from general registration data.
                        </p>
                        <p>
                            Your financial data is processed by the Business Manager and finance team. All data is securely stored in both paper and digital form and securely destroyed after 7 years in line with GDPR regulations. You are entitled to see the information we hold about you. If you wish to see this information, please send your request in writing to: Data Protection Officer, Pharmaceutical Society NI, 73 University Street, Belfast BT7 1HL, detailing the information you wish to see. We are required to respond within 30 days
                        </p>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">Proceed</div>

                    <div class="card-body">
                        <template v-for="field in fields_4">
                            <input-field-component @submit="eventHandler($event)" :field="field"></input-field-component>
                        </template>
                        
                    </div>
                </div>
            </div>
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
            counties: {
                type: Array,
                required: true,
            },
            universities: {
                type: Array,
                required: true,
            },
        },

        data() {
            return {

                fields_0: {
                    title: {
                        id: 'title',
                        name: 'Title',
                        type: 'select',
                        autocomplete: 'off',
                        error: false,
                        options: [
                            {
                                value: '',
                                display: 'Select Your Title',
                                disabled: true,
                            },
                            {
                                value: 'mr',
                                display: 'Mr',
                                disabled: false,
                            },
                            {
                                value: 'ms',
                                display: 'Ms',
                                disabled: false,
                            },
                            {
                                value: 'miss',
                                display: 'Miss',
                                disabled: false,
                            },
                            {
                                value: 'mrs',
                                display: 'Mrs',
                                disabled: false,
                            },
                            {
                                value: 'dr',
                                display: 'Dr',
                                disabled: false,
                            }

                        ],
                        external: false,
                        value: '',
                        required: true,
                    },
                    forenames: {
                        id: 'forenames',
                        name: 'Forename(s)',
                        extra: 'as on birth certificate',
                        type: 'text',
                        autocomplete: 'forename',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: true,
                    },
                    surname: {
                        id: 'surname',
                        name: 'Surname',
                        extra: '',
                        type: 'text',
                        autocomplete: 'surname',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: true,
                    },
                    known_as: {
                        id: 'known_as',
                        name: 'Known As',
                        extra: '',
                        type: 'text',
                        autocomplete: 'off',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: false,
                    },
                    previous_name: {
                        id: 'previous_name',
                        name: 'Previous Surname',
                        extra: '',
                        type: 'text',
                        autocomplete: 'off',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: false,
                    },
                    email: {
                        id: 'email',
                        name: 'Email',
                        extra: '',
                        type: 'email',
                        autocomplete: 'email',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: true,
                    },
                    date_of_birth: {
                        id: 'date_of_birth',
                        name: 'Date of Birth',
                        extra: '',
                        type: 'date',
                        autocomplete: 'off',
                        error: false,
                        options: [
                            {
                                minDate: null,
                                maxDate: (moment()).subtract(18, 'year' ).toDate(),
                                // loadPage: (moment()).subtract('year', 18),
                                loadPage: {
                                    month: ((moment()).subtract(18, 'year' ).month()+1),
                                    year: (moment()).subtract(18, 'year').year(),
                                },
                            }
                        ],
                        external: false,
                        value: '',
                        required: true,
                    },
                },
                fields_1: {
                    home_address_1: {
                        id: 'home_address_1',
                        name: 'Home Address Line 1',
                        extra: 'must be in Northern Ireland / UK',
                        type: 'text',
                        autocomplete: 'off',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: true,
                    },
                    home_address_2: {
                        id: 'home_address_2',
                        name: 'Home Address Line 2',
                        extra: '',
                        type: 'text',
                        autocomplete: 'off',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: false,
                    },
                    city: {
                        id: 'city',
                        name: 'Town / City',
                        extra: '',
                        type: 'text',
                        autocomplete: 'off',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: true,
                    },
                    county: {
                        id: 'county',
                        name: 'County',
                        extra: '',
                        type: 'select',
                        autocomplete: 'off',
                        error: false,
                        options: this.counties,
                        external: false,
                        value: '',
                        required: true,
                    },
                    postcode: {
                        id: 'postcode',
                        name: 'Postcode',
                        extra: '',
                        type: 'text',
                        autocomplete: 'off',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: true,
                    },
                    phone_mobile: {
                        id: 'phone_mobile',
                        name: 'Contact Number - Mobile',
                        extra: '',
                        type: 'text',
                        autocomplete: 'off',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: true,
                    },
                    phone_home:{
                        id: 'phone_home',
                        name: 'Contact Number - Home',
                        extra: '',
                        type: 'text',
                        autocomplete: 'off',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: false,
                    },
                },
                fields_2: {
                    university_id: {
                        id: 'university_id',
                        name: 'University',
                        extra: '',
                        type: 'select',
                        autocomplete: 'off',
                        error: false,
                        options: this.universities,
                        external: false,
                        value: '',
                        required: true,
                    },
                    entry_date: {
                        id: 'entry_date',
                        name: 'Date of Entry to Degree Course',
                        extra: '',
                        type: 'date',
                        autocomplete: 'off',
                        error: false,
                        options: [
                            {
                                minDate: (moment()).subtract(7, 'year' ).toDate(),
                                maxDate: (moment()).subtract(4, 'year' ).toDate(),
                                // loadPage: (moment()).subtract('year', 18),
                                loadPage: {
                                    month: ((moment()).subtract(4, 'year' ).month()+1),
                                    year: (moment()).subtract(4, 'year').year(),
                                },
                            }
                        ],
                        external: false,
                        value: '',
                        required: true,
                    },
                    completion_date: {
                        id: 'completion_date',
                        name: 'Degree Course Completion',
                        extra: '',
                        type: 'date',
                        autocomplete: 'off',
                        error: false,
                        options: [
                            {
                                minDate: (moment()).subtract(7, 'year' ).toDate(),
                                maxDate: (moment()).add(2, 'year' ).toDate(),
                                // loadPage: (moment()).subtract('year', 18),
                                // loadPage: {
                                //     month: ((moment()).subtract(4, 'year' ).month()+1),
                                //     year: (moment()).subtract(4, 'year').year(),
                                // },
                            }
                        ],
                        external: false,
                        value: '',
                        required: true,
                    },
                    previous_training: {
                        id: 'previous_training',
                        name: 'Previous Pre-Reg Training',
                        extra: '',
                        type: 'true_detail', // if true, show detail
                        autocomplete: 'off',
                        error: false,
                        options: {
                            __previous_training__details: {
                                id: '__previous_training__details',
                                name: 'Details of Previous Training',
                                extra: '',
                                type: 'textarea',
                                autocomplete: 'off',
                                error: false,
                                options: [],
                                external: false,
                                value: '',
                                required: true,
                            }
                        },
                        external: false,
                        value: false,
                        required: false,
                    },
                },
                fields_3: {
                    declaration_1: {
                        id: 'declaration_1',
                        name: 'I wish to become a registered trainee of the Pharmaceutical Society NI.',
                        extra: '',
                        type: 'boolean',
                        autocomplete: 'off',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: true,
                    },
                    declaration_2: {
                        id: 'declaration_2',
                        name: 'I will abide by the Pharmaceutical Society\'s Code and I understand my obligations as detailed in the supplementary professional standards and guidance.',
                        extra: 'https://www.psni.org.uk/wp-content/uploads/2012/09/22504-PSNI-Code-of-Practice-Book-final.pdf',
                        type: 'boolean',
                        autocomplete: 'off',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: true,
                    },
                    declaration_3: {
                        id: 'declaration_3',
                        name: 'I have read and understood and agree to adhere to the Pharmaceutical Society\'s Standards on Pre-registration Training.',
                        extra: 'https://www.psni.org.uk/wp-content/uploads/2012/10/PRE-REGISTRATION-STANDARDS-July-2012-revised-290419-FINAL.pdf',
                        type: 'boolean',
                        autocomplete: 'off',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: true,
                    },
                    declaration_4: {
                        id: 'declaration_4',
                        name: 'I know of no reason that would prohibit me from becoming a registered trainee of the Pharmaceutical Society NI.',
                        extra: '',
                        type: 'boolean',
                        autocomplete: 'off',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: true,
                    },
                    declaration_5: {
                        id: 'declaration_5',
                        name: 'I note the data protection statement below as it applies to relevant information held about me.',
                        extra: '',
                        type: 'boolean',
                        autocomplete: 'off',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: true,
                    },
                },
                fields_4: {
                    password: {
                        id: 'password',
                        name: 'Password',
                        extra: '',
                        type: 'password',
                        autocomplete: 'new-password',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: true,
                    },
                    password_confirmation: {
                        id: 'password_confirmation',
                        name: 'Confirm Password',
                        extra: '',
                        type: 'password',
                        autocomplete: 'new-password',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: true,
                    },
                    submit_step_1: {
                        id: 'submit_step_1',
                        name: 'Proceed to Payment',
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
                    case 'submit_step_1':

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

                for (const field in this.fields_0) {
                    formData.append([this.fields_0[field].id], this.fields_0[field].value);
                    this.fields_0[field].error = false;

                    if (this.fields_0[field].type == 'true_detail') {
                        let subOption = this.fields_0[field].options[Object.keys(this.fields_0[field].options)[0]];
                        formData.append([subOption.id], subOption.value);
                        subOption.error = false;
                    }
                }
                for (const field in this.fields_1) {
                    formData.append([this.fields_1[field].id], this.fields_1[field].value);
                    this.fields_1[field].error = false;

                    if (this.fields_1[field].type == 'true_detail') {
                        let subOption = this.fields_1[field].options[Object.keys(this.fields_1[field].options)[0]];
                        formData.append([subOption.id], subOption.value);
                        subOption.error = false;
                    }
                }
                for (const field in this.fields_2) {
                    formData.append([this.fields_2[field].id], this.fields_2[field].value);
                    this.fields_2[field].error = false;

                    if (this.fields_2[field].type == 'true_detail') {
                        let subOption = this.fields_2[field].options[Object.keys(this.fields_2[field].options)[0]];
                        formData.append([subOption.id], subOption.value);
                        subOption.error = false;
                    }
                }
                for (const field in this.fields_3) {
                    formData.append([this.fields_3[field].id], this.fields_3[field].value);
                    this.fields_3[field].error = false;

                    if (this.fields_3[field].type == 'true_detail') {
                        let subOption = this.fields_3[field].options[Object.keys(this.fields_3[field].options)[0]];
                        formData.append([subOption.id], subOption.value);
                        subOption.error = false;
                    }
                }
                for (const field in this.fields_4) {
                    formData.append([this.fields_4[field].id], this.fields_4[field].value);
                    this.fields_4[field].error = false;

                    if (this.fields_4[field].type == 'true_detail') {
                        let subOption = this.fields_4[field].options[Object.keys(this.fields_4[field].options)[0]];
                        formData.append([subOption.id], subOption.value);
                        subOption.error = false;
                    }
                }

                // submit form here
                var self = this;

                axios.post('/register', formData)
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
                            } else if(self.fields_1.hasOwnProperty(currentError)) {
                                self.fields_1[currentError].error = error.response.data.errors[currentError][0];
                            } else if(self.fields_2.hasOwnProperty(currentError)) {
                                self.fields_2[currentError].error = error.response.data.errors[currentError][0];
                            } else if(self.fields_3.hasOwnProperty(currentError)) {
                                self.fields_3[currentError].error = error.response.data.errors[currentError][0];
                            } else if(self.fields_4.hasOwnProperty(currentError)) {
                                self.fields_4[currentError].error = error.response.data.errors[currentError][0];
                            } else {
                                console.log(currentError);
                                let subError = currentError.split('__')[1];
                                console.log(subError[1]);

                                if(self.fields_0.hasOwnProperty(subError)) {
                                    self.fields_0[subError].options[currentError].error = error.response.data.errors[currentError][0];
                                } else if(self.fields_1.hasOwnProperty(subError)) {
                                    self.fields_1[subError].options[currentError].error = error.response.data.errors[currentError][0];
                                } else if(self.fields_2.hasOwnProperty(subError)) {
                                    self.fields_2[subError].options[currentError].error = error.response.data.errors[currentError][0];
                                } else if(self.fields_3.hasOwnProperty(subError)) {
                                    self.fields_3[subError].options[currentError].error = error.response.data.errors[currentError][0];
                                } else if(self.fields_4.hasOwnProperty(subError)) {
                                    self.fields_4[subError].options[currentError].error = error.response.data.errors[currentError][0];
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
