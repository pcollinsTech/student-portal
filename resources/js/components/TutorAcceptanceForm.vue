<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header"><strong></strong>Pharmacy Acceptance</div>

          <div class="card-body">
            <h3>Do you accept this student on Placement?</h3>
            <table class="table table-striped">
              <tbody>
              <tr>
                <td>Name</td>
                <td>{{ student.forenames }} {{ student.surname }}</td>
              </tr>
              <tr>
                <td>Start Date</td>
                <td>{{ tutor.tutor_start }}</td>
              </tr>
              <tr>
                <td>End Date</td>
                <td>{{ tutor.tutor_end }}</td>
              </tr>
              <tr v-for="pharmacy in pharmacies">
                <td>Location</td>
                <td>
                  {{ pharmacy.trading_name }} <br>
                  {{ pharmacy.address_1 }} <br>
                  {{ pharmacy.post_code }}, {{ pharmacy.county }}
                </td>
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
            <template v-for="field in fields_1" v-else>
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
</template>

<script>
import moment from "moment";

export default {
  mounted() {
    console.log("Component mounted.");
    this.active = this.tutor.active;
  },

  props: {
    tutor: {
        type: Object,
        required: true,
    },
    student: {
      type: Object,
      required: true,
    },
    pharmacies: {
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
          name:
            "I confrim that I have agreed to be the tutor for the above name trainee in the above names premises for the dates indicated.",
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
          name:
            "I have been in practise in this sector of pharmacy for a minimum of 3 years",
          extra: "",
          type: "boolean",
          autocomplete: "off",
          error: false,
          options: [],
          external: false,
          value: "",
          required: true
        },
        pharmacy_declaration_3: {
          id: "pharmacy_declaration_3",
          name:
            "I have read and understood and agree to adhere to the Pharamaceutical Society's requirements and conditions for pre-registration tutors as described in the standards",
          extra: "",
          type: "boolean",
          autocomplete: "off",
          error: false,
          options: [],
          external: false,
          value: "",
          required: true
        },
        pharmacy_declaration_4: {
          id: "pharmacy_declaration_4",
          name:
            "I confirm that i meet the Pharmaceutical Society's requirements for tutors (completed course)",
          extra: "",
          type: "boolean",
          autocomplete: "off",
          error: false,
          options: [],
          external: false,
          value: "",
          required: true
        },
        pharmacy_declaration_5: {
          id: "pharmacy_declaration_5",
          name:
            "I confirm that I am compliant with the Pharmaceutical Society's Continuing Professional Development system",
          extra: "",
          type: "boolean",
          autocomplete: "off",
          error: false,
          options: [],
          external: false,
          value: "",
          required: true
        },
        pharmacy_declaration_5: {
          id: "pharmacy_declaration_5",
          name:
            "I note the data protection statement as it applies to relevant information held about me",
          extra: "",
          type: "boolean",
          autocomplete: "off",
          error: false,
          options: [],
          external: false,
          value: "",
          required: true
        },
        pharmacist_reg_number: {
          id: "pharmacist_reg_number",
          name: "Registration Number",
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
    };
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
      // Clear all Errors
      this.errors = null;
      var formData = {};

      formData.currentStep = "pharmacy_declaration";

      for (const field in this.fields_1) {
        formData[this.fields_1[field].id] =  this.fields_1[field].value;
        this.fields_1[field].error = false;

        if (this.fields_1[field].type == "true_detail") {
          let subOption = this.fields_1[field].options[
            Object.keys(this.fields_1[field].options)[0]
          ];
          formData[subOption.id] =  subOption.value;
          subOption.error = false;
        }
      }

      // submit form here
      var self = this;

      axios
        .put(`/verify/tutor/${this.tutor.id}`, formData)
        .then(( { data } ) => {
          // Proceed to next step
          this.active = data.active;

          // Redirect to the Registration Payment
          // window.location.replace("/registration");
        })
          .catch( (err) => {
            this.errors = err.response.data;
          });
        // .catch(function(error) {
        //   // Set Error Messages
        //   for (const currentError in error.response.data.errors) {
        //     if (self.fields_0.hasOwnProperty(currentError)) {
        //       self.fields_0[currentError].error =
        //         error.response.data.errors[currentError][0];
        //     } else {
        //       console.log(currentError);
        //       let subError = currentError.split("__")[1];
        //       console.log(subError[1]);
        //
        //       if (self.fields_0.hasOwnProperty(subError)) {
        //         self.fields_0[subError].options[currentError].error =
        //           error.response.data.errors[currentError][0];
        //       }
        //     }
        //   }
        //
        //   // Scroll to top of page smoothly
        //   window.scrollTo({
        //     top: 0,
        //     behavior: "smooth"
        //   });
        //
        //   // Re-enable the form
        //   self.$emit("enabled", submitTrigger);
        // });
    }
  },

  computed: {
    countyOptions: function() {}
  }
};
</script>
