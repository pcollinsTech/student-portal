/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import moment from 'moment'

import VCalendar from 'v-calendar';

import { BFormFile } from 'bootstrap-vue'

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

Vue.prototype.moment = moment

// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)


// Event Emiter Vue Instance
window.Bus = new Vue();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('registration-component', require('./components/RegistrationComponent.vue').default);
Vue.component('input-field-component', require('./components/InputFieldComponent.vue').default);
Vue.component('repeater-field-component', require('./components/RepeaterFieldComponent.vue').default);
Vue.component('payment-component', require('./components/PaymentComponent.vue').default);
Vue.component('character-declaration-component', require('./components/CharacterDeclarationComponent.vue').default);
Vue.component('health-declaration-component', require('./components/HealthDeclarationComponent.vue').default);
Vue.component('supporting-documents-component', require('./components/SupportingDocumentsComponent.vue').default);
Vue.component('placement-details-component', require('./components/PlacementSelectComponent.vue').default);
Vue.component('tutor-details-component', require('./components/TutorSelectComponent.vue').default);
Vue.component('pharmacy-acceptance', require('./components/PharmacyAcceptanceForm.vue').default);
Vue.component('tutor-acceptance', require('./components/TutorAcceptanceForm.vue').default);
Vue.component('b-form-file', BFormFile)
Vue.component('vslider', require('./components/Slider.vue').default)
Vue.component('vinput', require('./components/VInput.vue').default)
Vue.component('application', require('./components/Application.vue').default)
Vue.component('vselect', require('./components/VSelect.vue').default)
Vue.component('vswitchinline', require('./components/VSwitchInline.vue').default)
Vue.component('vtogglebuttons', require('./components/VToggleButtons.vue').default)
Vue.component('vradio', require('./components/VRadio.vue').default)
Vue.component('vdate', require('./components/VDate.vue').default)
Vue.component('vupload', require('./components/VUpload.vue').default)
Vue.component('charger', require('./components/Charger.vue').default)
Vue.component('toast', require('./components/Charger.vue').default)
Vue.component('vnotys', require('./components/VNoty.vue').default)
Vue.component('Counties', require('./components/Counties.vue').default)


// Use v-calendar & v-date-picker components
Vue.use(VCalendar, {
    componentPrefix: 'vc',  // Use <vc-calendar /> instead of <v-calendar />
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    mounted() {

        let local = this;
        window.onload = function () {

            this.setTimeout(() => {
                document.body.style.opacity = 1;
            }, 1500)
        }
    }
})
