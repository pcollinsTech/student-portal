<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">tutor Details</div>

          <div class="card-body">
            
            <template v-for="field in fields_0">
              <input-field-component
                @submit="eventHandler($event)"
                @tutors="repeaterHandler($event)"
                :field="field"
              ></input-field-component>
            </template>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6"><a href="/back"><button class="btn btn-info">Back</button></a></div>
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
    // counties: {
    //     type: Array,
    //     required: true,
    // },
    tutors: {
      type: Array,
      required: true
    },
    tutor_start: {
      type: String,
      required: true
    }
  },

  data() {
    return {
      fields_0: {
        number_of_tutors: {
          id: "number_of_tutors",
          name: "Number of Tutors.",
          extra:
            "Select if you will be undertaking your  at 1 Tutor for 12 months or 2 separate Tutors for 6 months each.",
          type: "has_2_options",
          autocomplete: "off",
          error: false,
          options: [
            {
              value: 1,
              text: "1 Tutor"
            },
            {
              value: 2,
              text: "2 Tutors"
            }
          ],
          external: "tutors",
          value: 0,
          required: true
        },
        tutors: {
          id: "tutors",
          name: "tutors",
          extra: "",
          type: "repeater",
          autocomplete: "off",
          error: false,
          options: {
            __tutors__selection: {
              id: "__tutors__selection",
              name: "Select Tutor",
              extra: "",
              type: "select",
              autocomplete: "off",
              error: false,
              options: this.tutors,
              external: false,
              value: [""],
              required: false
            },
            __tutors__start: {
              id: "__tutors__start",
              name: "Tutor Start Date",
              extra: "",
              type: "date",
              autocomplete: "off",
              error: false,
              options: [
                {
                  minDate: moment(this.tutor_start).toDate(),
                  maxDate: null,
                  loadPage: {
                    month: moment(this.tutor_start).month() + 1,
                    year: moment(this.tutor_start).year()
                  }
                },
                {
                  minDate: moment(this.tutor_start)
                    .add(6, "month")
                    .toDate(),
                  maxDate: null,
                  loadPage: {
                    month:
                      moment(this.tutor_start)
                        .add(6, "month")
                        .month() + 1,
                    year: moment(this.tutor_start)
                      .add(6, "month")
                      .year()
                  }
                }
              ],
              external: false,
              value: [],
              required: false
            },
            __tutors__end: {
              id: "__tutors__end",
              name: "Tutor end Date",
              extra: "",
              type: "date",
              autocomplete: "off",
              error: false,
              options: [
                {
                  minDate: moment(this.tutor_end).toDate(),
                  maxDate: null,
                  loadPage: {
                    month: moment(this.tutor_end).month() + 1,
                    year: moment(this.tutor_end).year()
                  }
                },
                {
                  minDate: moment(this.tutor_end)
                    .add(6, "month")
                    .toDate(),
                  maxDate: null,
                  loadPage: {
                    month:
                      moment(this.tutor_end)
                        .add(6, "month")
                        .month() + 1,
                    year: moment(this.tutor_end)
                      .add(6, "month")
                      .year()
                  }
                }
              ],
              external: false,
              value: [],
              required: false
            }
          },
          external: "number_of_tutors",
          value: "",
          required: true
        },
        submit_step_6: {
          id: "submit_step_6",
          name: "Complete Registration",
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
    repeaterHandler(val) {
      console.log("repeaterHandler val", val.value)
      console.log("repeaterHandler field", val.field)
      this.fields_0[val.field].value = val.value;
    },

    eventHandler(fieldId) {
      switch (fieldId) {
        case "submit_step_6":
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
      var formData = {};

      formData.currentStep = "tutor_details";

      for (const field in this.fields_0) {
        formData[this.fields_0[field].id] = this.fields_0[field].value;
        this.fields_0[field].error = false;
        console.log("fields_0", this.fields_0)
        console.log("FIELD", field)
        if (field === "tutors") {
            let placmentId = this.fields_0[field].options[
              Object.keys(this.fields_0[field].options)[0]
            ];
            let start = this.fields_0[field].options[
              Object.keys(this.fields_0[field].options)[1]
            ];

          let end = this.fields_0[field].options[
              Object.keys(this.fields_0[field].options)[2]
          ];
            
          if (this.fields_0.value === 2 ) {
            formData[field] = [
              { 
                tutor_id: placmentId.value[0],
                tutor_start: start.value[0],
                tutor_end: end.value[0]
              },
              { 
                tutor_id: placmentId.value[1],
                tutor_start: start.value[1],
                tutor_end: end.value[1]
              },
            ]


          } else {
            
            formData[field] = [{ 
              tutor_id: placmentId.value,
              tutor_start: start.value,
              tutor_end: end.value
            }]
            placmentId.error = false;
            
          }

        }
        
      }

      // submit form here
    console.log(formData)
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
            if (this.fields_0.hasOwnProperty(currentError)) {
              this.fields_0[currentError].error =
                error.response.data.errors[currentError][0];
            } else {
              console.log(currentError);
              let subError = currentError.split("__")[1];
              console.log(subError[1]);

              if (this.fields_0.hasOwnProperty(subError)) {
                this.fields_0[subError].options[currentError].error =
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
