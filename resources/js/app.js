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
Vue.component('b-form-file', BFormFile)

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
});
