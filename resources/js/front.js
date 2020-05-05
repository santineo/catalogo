require('./bootstrap');
require('./events');
import Cart from './classes/Cart';
import Alert from './classes/Alert';

window.Vue = require('vue');
window.Cart = new Cart();
window.Alert = new Alert();

Vue.component('product-checkout', require('./front/ProductCheckoutComponent.vue').default);
Vue.component('cart', require('./front/CartComponent.vue').default);
Vue.component('cart-products', require('./front/CartProducts.vue').default);
Vue.component('checkout-form', require('./front/CheckoutForm.vue').default);
Vue.component('alert', require('./front/AlertComponent.vue').default);

const app = new Vue({
    el: '#front',
    data:{
      Cart: window.Cart
    }
});
