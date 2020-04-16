<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Placement Details</div>
          <div class="card-body">
            <template v-for="field in fields_0">
              <input-field-component
                @submit="eventHandler($event)"
                @placements="repeaterHandler($event)"
                :field="field"
              ></input-field-component>
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
    pharmacies: {
      type: Array,
      required: true
    },
    placement_start: {
      type: String,
      required: true
    }
  },

  data() {
    return {
      fields_0: {
        number_of_placements: {
          id: "number_of_placements",
          name: "Number of Placements.",
          extra:
            "Select if you will be undertaking your placement at 1 Pharmacy for 12 months or 2 separate Pharmacies for 6 months each.",
          type: "has_2_options",
          autocomplete: "off",
          error: false,
          options: [
            {
              value: 1,
              text: "1 Pharmacy"
            },
            {
              value: 2,
              text: "2 Pharmacies"
            }
          ],
          external: "placements",
          value: 0,
          required: true
        },
        placements: {
          id: "placements",
          name: "Placements",
          extra: "",
          type: "repeater",
          autocomplete: "off",
          error: false,
          options: {
            __placements__pharmacy: {
              id: "__placements__pharmacy",
              name: "Select Pharmacy",
              extra: "",
              type: "select",
              autocomplete: "off",
              error: false,
              options: this.pharmacies,
              external: false,
              value: [""],
              required: false
            },
            __placements__start: {
              id: "__placements__start",
              name: "Placement Start Date",
              extra: "",
              type: "date",
              autocomplete: "off",
              error: false,
              options: [
                {
                  minDate: moment(this.placement_start).toDate(),
                  maxDate: null,
                  loadPage: {
                    month: moment(this.placement_start).month() + 1,
                    year: moment(this.placement_start).year()
                  }
                },
                {
                  minDate: moment(this.placement_start)
                    .add(6, "month")
                    .toDate(),
                  maxDate: null,
                  loadPage: {
                    month:
                      moment(this.placement_start)
                        .add(6, "month")
                        .month() + 1,
                    year: moment(this.placement_start)
                      .add(6, "month")
                      .year()
                  }
                }
              ],
              external: false,
              value: [],
              required: false
            },
            __placements__end: {
              id: "__placements__end",
              name: "Placement end Date",
              extra: "",
              type: "date",
              autocomplete: "off",
              error: false,
              options: [
                {
                  minDate: moment(this.placement_end).toDate(),
                  maxDate: null,
                  loadPage: {
                    month: moment(this.placement_end).month() + 1,
                    year: moment(this.placement_end).year()
                  }
                },
                {
                  minDate: moment(this.placement_end)
                    .add(6, "month")
                    .toDate(),
                  maxDate: null,
                  loadPage: {
                    month:
                      moment(this.placement_end)
                        .add(6, "month")
                        .month() + 1,
                    year: moment(this.placement_end)
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
          external: "number_of_placements",
          value: "",
          required: true
        },
        submit_step_6: {
          id: "submit_step_6",
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
    repeaterHandler(val) {
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
      // var formData = new FormData();
      var formData = {};
      formData.currentStep = "placement_details";

      for (const field in this.fields_0) {

        formData[this.fields_0[field].id] = this.fields_0[field].value;
        this.fields_0[field].error = false;
        if (field === "placements") {
            let placmentId = this.fields_0[field].options[
              Object.keys(this.fields_0[field].options)[0]
            ];
            let time = this.fields_0[field].options[
              Object.keys(this.fields_0[field].options)[1]
            ];
            let end = this.fields_0[field].options[
              Object.keys(this.fields_0[field].options)[2]
            ];
            
          if (this.fields_0.value === 2 ) {

            formData[field] = [
              {
                placement_id: placmentId.value[0],
                placement_start: time.value[0],
                placement_end: time.value[0],
              },
              {
                placement_id: placmentId.value[1],
                placement_start: time.value[1],
                placement_end: time.value[1],
              },
            ]


          } else {
            
            formData[field] = [{
              placement_id: placmentId.value,
              placement_start: time.value,
              placement_end: time.value,
            }];
            placmentId.error = false;
            
          }

        }
        
      }

      // submit form here
      console.log(formData);
      axios
        .post("/registrationTEST", formData)
        .then(function(response) {
          // Proceed to next step
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
