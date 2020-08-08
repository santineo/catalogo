require('./bootstrap');
require('./events');

import Swiper, { Navigation, Pagination, Controller } from 'swiper';
import Cart from './classes/Cart';
import Alert from './classes/Alert';

import 'swiper/swiper-bundle.css';

window.Vue = require('vue');
window.Cart = new Cart();
window.Alert = new Alert();
window.Swiper = Swiper;

Vue.component('product-checkout', require('./front/ProductCheckoutComponent.vue').default);
Vue.component('cart', require('./front/CartComponent.vue').default);
Vue.component('cart-products', require('./front/CartProducts.vue').default);
Vue.component('checkout-form', require('./front/CheckoutForm.vue').default);
Vue.component('contact-form', require('./front/ContactFormComponent.vue').default);
Vue.component('alert', require('./front/AlertComponent.vue').default);

Swiper.use([Navigation, Pagination]);

const init = () => {
  // HOMESCRIPTS
  if($('#home').length){
    require('./front/scripts/home');
  }

};

const app = new Vue({
    el: '#front',
    data:{
      Cart: window.Cart
    },
    mounted(){
      // SETTIMEOUT FIX WIDTH PROBLEM
      setTimeout(init, 300);
    }
});
