<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Supporting Documents</div>

          <div class="card-body">
            <div>
              <a href="/forms/photo_verification_form.pdf" download v-if="downloadPdf">
                <button
                  class="btn btn-success mb-4"
                  style="color: white"
                  @click="downloadPdf"
                >
                  Download Certification Form
                </button>
              </a>
            <br/>
            </div>
            <div class="supporting-documents">
              <div v-if="uploading" class="supporting-documents__loading">
                <h4>Uploading...</h4>
              </div>
              <div>
                <template v-for="field in fields_0">
                  <input-field-component @submit="eventHandler($event)" :field="field"></input-field-component>
                </template>
              </div>
            </div>
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
    loading:false,
    downloadPdf: null,
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
      uploading: false,
      fields_0: {
        document__birth_certificate: {
          id: "document__birth_certificate",
          name: "Original Birth Certificate",
          extra: "Copy",
          type: "file_upload",
          autocomplete: "off",
          error: false,
          options: [],
          external: false,
          value: null,
          required: false
        },
        document__proof_identity: {
          id: "document__proof_identity",
          name: "Proof of Identity Document",
          extra:
            "A UK/EEA full or provisional photocard driving license, current valid passport (must show expiry and photo) or an EEA identity card will be accepted.",
          type: "file_upload",
          autocomplete: "off",
          error: false,
          options: [],
          external: false,
          value: null,
          required: false
        },
        document__passport_photograph: {
          id: "document__passport_photograph",
          name: "Passport Photograph to Verify Identity",
          extra:
            "To accompany verification form",
          type: "file_upload",
          autocomplete: "off",
          error: false,
          options: [],
          external: false,
          value: null,
          required: false
        },
        document__degree_certificate: {
          id: "document__degree_certificate",
          name: "Degree Certificate / OSPAP",
          extra:
            "If in your possession. (You will have the ability to upload this at a later stage if not provided.)",
          type: "file_upload",
          autocomplete: "off",
          error: false,
          options: [],
          external: false,
          value: null,
          required: false
        },
        submit_step_5: {
          id: "submit_step_5",
          name: "Upload Documents",
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
        case "submit_step_5":
          // disable the button which was clicked
          this.$emit("disabled", fieldId);

          // submit the form
          this.submitForm(fieldId);

          console.log(this.fields_0);
          break;
        

        default:
          // do nothing if not defined
          break;
      }
    },
    // get the form download with their name na
   

    submitForm(submitTrigger) {
      // Clear all Errors

      var formData = new FormData();

      formData.append("currentStep", "supporting_documents");

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

      this.uploading = true;
      axios
        .post("/registration", formData)
        .then(res => {
          // Proceed to next step
          // console.log(response);
          this.uploading = false;
          // Redirect to the Registration Payment
          window.location.replace("/registration");
        })
        .catch(error => {
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
