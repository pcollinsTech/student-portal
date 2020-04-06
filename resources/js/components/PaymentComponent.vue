<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Payment Details</div>

          <div class="card-body">
            <p>A fee of £206 will be require to proceed</p>

            <template v-for="field in fields_0">
              <input-field-component @submit="eventHandler($event)" :field="field"></input-field-component>
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
        submit_step_2: {
          id: "submit_step_2",
          name: "Complete Payment",
          extra: "",
          type: "submit",
          autocomplete: "off",
          error: false,
          options: [],
          external: false,
          value: "btn-primary",
          required: true
        }
      }
    };
  },

  methods: {
    eventHandler(fieldId) {
      switch (fieldId) {
        case "submit_step_2":
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

      formData.append("currentStep", "payment");

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
          // console.log(response);

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
