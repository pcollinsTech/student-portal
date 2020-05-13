
<script>
import RealexHpp from '../helpers/rxp-hpp.js';
import { Application } from '../models/application';

export default {
  props: {
    user: {
      type: Object,
      default: () => null
    }
  },
  data() {
    return {
      step: 0,
      paymentControlActive: false,
      ready: false,
      edit: false
    };
  },
  methods: {
    scrollTop() {
      $('html, body')
        .stop()
        .animate({ scrollTop: 0 }, 500, 'swing');
    },
    setEditMode() {
      if (this.edit) {
        this.submitApplication();
        this.step = 5;
      } else {
        this.setStep(1);
        this.edit = true;
      }
    },
    submitApplication(paynow = false) {
      this.edit = false;
      window.application.form.clearErrors();
      window.application.form.step = this.step;
      window.application.form.paynow = paynow;
      window.application.form.submit().then(payload => {
        if (payload.result) {
          toastr.info('Application Saved');

          if (window.application.form.id === -1 || paynow) {
            toastr.success('Processing Payment');
            window.application.form.id = payload.data.id;
            this.paymentStep();
          }
        }
      });
    },
    paymentStep() {
      let form = window.application.form;

      let payload = {
        student_id: form.id,
        student_email: form.email,
        student_phone: form.phone_mobile,
        streetAddress1: form.street_address_1,
        billing_city: form.city,
        billing_post_code: form.post_code,
        billing_country: '840'
      };

      axios
        .get('/payment/request', {
          params: payload
        })
        .then(({ data }) => {
          RealexHpp.setHppUrl('https://pay.sandbox.realexpayments.com/pay');
          RealexHpp.embedded.init(
            'paymentButton',
            'payment-container',
            'payment/response',
            data
          );

          window.application.form.payment.status = 'created';

          setTimeout(() => {
            this.activatePayment();
          }, 1000);
        });
    },

    activatePayment() {
      this.paymentControlActive = true;
      document.querySelector('#paymentButton').click();
    },

    setStep(index) {
      this.step = index;
      this.scrollTop();
    },

    next() {
      window.application.form.step = this.step;
      window.application.form.submit().then(response => {
        let payload = response.data;

        if (this.step < 5) this.step += 1;
      });

      this.scrollTop();
    },

    prev() {
      if (this.step > 0) this.step -= 1;
      this.scrollTop();
    },

    checkUserAndBind() {
      // if logged set Application
      if (this.user !== null) {
        let application = new Application();
        application.bind(this.user);
        this.step = 5;
        Bus.$emit('set-application', application);
      }
    }
  },
  mounted() {
    window.slider = this;

    Bus.$on('submit-application', () => {
      this.submitApplication();
    });

    Bus.$on('pay-now', () => {
      this.submitApplication(true);
    });

    setTimeout(() => {
      this.ready = true;

      setTimeout(() => {
        this.checkUserAndBind();
      }, 500);
    }, 200);

    // Check if user is presente and bind application
  }
};
</script>
