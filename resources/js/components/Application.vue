
<script>
import { Application } from '../models/application';
import { Form } from '../core/form';
import { Pharmacie } from '../models/pharmacie';
import { Tutor } from '../models/tutor';
import Payment from '../core/payment';
import { File } from '../core/File';

export default {
  props: {
    step: {
      type: Number,
      default: () => 0
    }
  },

  computed: {
    paymentControlActive() {
      return window.slider.paymentControlActive;
    }
  },

  data() {
    return {
      form: new Form('/application', new Application()),
      pharmaciesCount: 1,
      tutorsCount: 1,
      ready: false,
      edit: false,
      slider: window.slider
    };
  },

  methods: {
    payNow() {
      Bus.$emit('pay-now');
    },

    updatePharmacies(value) {
      let count = parseInt(value);

      if (count > this.form.pharmacies.length) {
        count = count - this.form.pharmacies.length;
        for (var i = 0; i < count; i++) {
          this.form.pharmacies.push(new Pharmacie(null));
        }
      } else {
        this.form.pharmacies.splice(count);
      }
    },

    updateTutors(value) {
      let count = parseInt(value);

      if (count > this.form.tutors.length) {
        count = parseInt(value) - this.form.tutors.length;
        for (var i = 0; i < count; i++) {
          this.form.tutors.push(new Tutor(null));
        }
      } else {
        this.form.tutors.splice(count);
      }
    },

    submitApplication() {
      Bus.$emit('submit-application');
    }
  },
  mounted() {
    console.log('applicaiton started');

    Bus.$on('application-docs-upload', document => {
      switch (document.type) {
        case 'birth_certificate':
          this.form.documents.birth_certificate = document;
          break;
        case 'proof_identity':
          this.form.documents.proof_identity = document;
          break;
        case 'passport_photograph':
          this.form.documents.passport_photograph = document;
          break;
        case 'degree_certificate':
          this.form.documents.degree_certificate = document;
          break;
      }
    });

    Bus.$on('application-docs-delete', type => {
      switch (type) {
        case 'birth_certificate':
          this.form.documents.birth_certificate = null;
          break;
        case 'proof_identity':
          this.form.documents.proof_identity = null;
          break;
        case 'passport_photograph':
          this.form.documents.passport_photograph = null;
          break;
        case 'degree_certificate':
          this.form.documents.degree_certificate = null;
          break;
      }
    });

    window.application = this;

    // Event to set applicaiton
    Bus.$on('set-application', application => {
      this.ready = false;
      this.form = new Form('/application', application);

      this.pharmaciesCount = this.form.pharmacies.length;
      this.tutorsCount = this.form.tutors.length;

      setTimeout(() => {
        this.ready = true;

        setTimeout(() => {
          this.form.student.registration.documents.forEach(file => {
            let parsedFile = new File();
            parsedFile.data = file.file_path;
            parsedFile.name = file.file_type;
            parsedFile.type = file.file_type;
            parsedFile.mode = '/storage/' + file.id;

            Bus.$emit(
              'application-docs-set-file-' + parsedFile.type,
              parsedFile
            );
          });
        }, 200);
      }, 400);
    });
  }
};
</script>
