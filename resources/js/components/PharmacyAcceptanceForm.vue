<template>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><strong></strong>Pharmacy Acceptance</div>

                    <div class="card-body">
                        <h3>Do you accept this student on Placement?</h3>

                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ student.forenames }} {{ student.surname }}</td>
                                </tr>
                                <tr>
                                    <td>Start Date</td>
                                    <td>{{ placement.placement_start }}</td>
                                </tr>
                                <tr>
                                    <td>End Date</td>
                                    <td>{{ placement.placement_end }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header"><strong></strong>Pharmacy Declarations</div>

                    <div class="alert alert-danger" v-if="errors">
                        <ul v-for="error in errors">
                            <li v-for="message in error">{{message}}</li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="alert alert-success" v-if="active">
                            Student has been successfully verified
                        </div>
                        <div v-else>
                            <p class="text-right">Click on buttons to confirm.</p>
                                <p>* represents required fields</p>
                            <template v-for="field in fields_1">
                                <input-field-component
                                        @submit="eventHandler($event)"
                                        :field="field"
                                ></input-field-component>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            student: {
                required: true
            },
            placement: {
                required: true
            }
        },
        data() {
            return {
                errors: null,
                active: false,
                fields_1: {
                    pharmacy_declaration_1: {
                        id: "pharmacy_declaration_1",
                        name: "Training will be at the pharmacy premises specified with no more than two weeks spent at branch of my business and in total, no more than six weeks away from the main training site (pro rata for six month placement)",
                        extra: "",
                        type: "boolean",
                        autocomplete: "off",
                        error: false,
                        options: [],
                        external: false,
                        value: "",
                        required: true
                    },
                    pharmacy_declaration_2: {
                        id: "pharmacy_declaration_2",
                        name: "I have obtained prior approval for a flexible training programme.",
                        extra: "",
                        type: "boolean",
                        autocomplete: "off",
                        error: false,
                        options: [],
                        external: false,
                        value: "",
                        required: true
                    },
                    pharmacy_reg_number: {
                        id: "pharmacy_reg_number",
                        name: "Tutor Registration Number",
                        extra: "",
                        type: "text",
                        autocomplete: "tutor_reg_number",
                        error: false,
                        options: [],
                        external: false,
                        value: "",
                        required: true
                    },
                    submit_step_4: {
                        id: "submit_step_4",
                        name: "Proceed to Next Step",
                        extra: "",
                        type: "submit",
                        autocomplete: "off",
                        error: false,
                        options: [],
                        external: false,
                        value: "btn-primary", // when submit this is the class field
                        required: true
                    }
                }

            }
        },
        mounted() {
          this.active = this.placement.active;
        },
        methods: {
            eventHandler(fieldId) {
                switch (fieldId) {
                    case "submit_step_4":
                        // disable the button which was clicked
                        // this.$emit("disabled", fieldId);

                        // submit the form
                        this.submitForm(fieldId);
                        break;

                    default:
                        // do nothing if not defined
                        break;
                }
            },

            submitForm(submitTrigger) {
                this.errors = null;
                let formData = {};

                formData.currentStep = 'pharmacy_declaration';

                for (const field in this.fields_1) {
                    formData[this.fields_1[field].id] = this.fields_1[field].value;
                    this.fields_1[field].error = false;

                    if (this.fields_1[field].type == "true_detail") {
                        let subOption = this.fields_1[field].options[
                            Object.keys(this.fields_1[field].options)[0]
                            ];
                        formData[subOption.id] = subOption.value;
                        subOption.error = false;
                    }
                }
                console.log(formData);
                axios.put(`/verify/pharmacy/${this.placement.id}`, formData).then(({ data }) => {
                    this.active = data.active;
                }).catch( (err) => {
                    this.errors = err.response.data;
                });
            }
        }
    }
</script>