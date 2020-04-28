/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./events');
require('./admin/functions');
window.Vue = require('vue');


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('edit-button', require('./components/buttons/EditComponent.vue').default);
Vue.component('delete-button', require('./components/buttons/DeleteComponent.vue').default);
Vue.component('order-form', require('./components/OrderFormComponent.vue').default);
Vue.component('modal-confirm', require('./components/ModalComponent.vue').default);
Vue.component('errors', require('./components/ErrorsComponent.vue').default);
Vue.component('image-input', require('./components/ImageInputComponent.vue').default);
Vue.component('price-input', require('./components/PriceComponent.vue').default);
Vue.component('stock-input', require('./components/StockComponent.vue').default);
Vue.component('create-select', require('./components/CreateSelectComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
