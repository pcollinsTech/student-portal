<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header"><strong></strong>Pharmacy Acceptance</div>

          <div class="card-body">
            <h3>Do you accept this student on Placement?</h3>
            <p>{{ this.student.forenames}} {{ this.student.surname }}</p>
            <template v-for="field in fields_0">
              <input-field-component
                @submit="eventHandler($event)"
                :field="field"
              ></input-field-component>
            </template>
          </div>
        </div>
        <div class="card mt-4">
          <div class="card-header"><strong></strong>Pharmacy Declarations</div>

          <div class="card-body">
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
</template>

<script>
import moment from "moment";

export default {
  mounted() {
    console.log("Component mounted.");
  },

  props: {
    student: {
        type: Object,
        required: true,
    },
  },
  data() {
    return {
      fields_0: {
        
        trading_name: {
          id: "trading_name",
          name: "Trading Name",
          extra: "",
          type: "text",
          autocomplete: "trading_name",
          error: false,
          options: [],
          external: false,
          value: "",
          required: true
        },
        placement_start_date: {
            id: 'placement_start_date',
            name: 'Training Start Date',
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
        
        placement_end_date: {
          id: "placement_end_date",
          name: "Training End Date",
          extra: "",
          type: "date",
          autocomplete: "off",
          error: false,
          options: [
            {
              minDate: null,
              maxDate: moment()
                .subtract(18, "year")
                .toDate(),
              // loadPage: (moment()).subtract('year', 18),
              loadPage: {
                month:
                  moment()
                    .subtract(18, "year")
                    .month() + 1,
                year: moment()
                  .subtract(18, "year")
                  .year()
              }
            }
          ],
          external: false,
          value: "",
          required: true
        }
      },
      fields_1: {
        pharmacy_declaration_1: {
          id: "pharmacy_declaration_2",
          name:
            "Training will be at the pharmacy premises specified with no more than two weeks spent at branch of my business and in total, no more than six weeks away from the main training site (pro rata for six month placement)",
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
            "I have obtained prior approval for a flexible training programme.",
          extra: "",
          type: "boolean",
          autocomplete: "off",
          error: false,
          options: [],
          external: false,
          value: "",
          required: true
        },
        name_of_tutor: {
          id: "name_of_tutor",
          name: "Name of Register Tutor",
          extra: "",
          type: "text",
          autocomplete: "name_of_tutor",
          error: false,
          options: [],
          external: false,
          value: "",
          required: true
        },
        tutor_reg_number: {
          id: "tutor_reg_number",
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
    };
  },

  methods: {
    eventHandler(fieldId) {
      switch (fieldId) {
        case "submit_step_4":
          // disable the button which was clicked
          this.$emit("disabled", fieldId);

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

      formData.append("currentStep", "pharmacy_declaration");

      for (const field in this.fields_0) {
        formData.append([this.fields_0[field].id], this.fields_0[field].value);
        this.fields_0[field].error = false;

        if (this.fields_0[field].type == "true_detail") {
          let subOption = this.fields_0[field].options[
            Object.keys(this.fields_0[field].options)[0]
          ];
          formData.append([subOption.id], subOption.value);
          subOption.error = false;
        }
      }

      // submit form here
      var self = this;

      axios
        .post("/registration", formData)
        .then(function(response) {
          // Proceed to next step
          console.log(response);

          // Redirect to the Registration Payment
          window.location.replace("/registration");
        })
        .catch(function(error) {
          // Set Error Messages
          for (const currentError in error.response.data.errors) {
            if (self.fields_0.hasOwnProperty(currentError)) {
              self.fields_0[currentError].error =
                error.response.data.errors[currentError][0];
            } else {
              console.log(currentError);
              let subError = currentError.split("__")[1];
              console.log(subError[1]);

              if (self.fields_0.hasOwnProperty(subError)) {
                self.fields_0[subError].options[currentError].error =
                  error.response.data.errors[currentError][0];
              }
            }
          }

          // Scroll to top of page smoothly
          window.scrollTo({
            top: 0,
            behavior: "smooth"
          });

          // Re-enable the form
          self.$emit("enabled", submitTrigger);
        });
    }
  },

  computed: {
    countyOptions: function() {}
  }
};
</script>
