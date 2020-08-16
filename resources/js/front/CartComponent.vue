<template>
  <div v-if="(Cart && !token)">
    <destroy-product :product="Cart.modals.destroy.product" />
    <modify-product :product="Cart.modals.modify.product" />
  </div>
</template>

<script>
import DestroyProductCart from './DestroyProductCart.vue';
import ModifyProductCart from './ModifyProductCart.vue';
export default {
  props: ['token'],
  components: {
    'destroy-product': DestroyProductCart,
    'modify-product': ModifyProductCart
  },
  data(){
    return {
      Cart,
      loading: false,
      active: false
    }
  },
  created(){
    if(this.token){
      const url = new URL(window.location.href);
      if(url.searchParams.get('token') != this.token){
        url.searchParams.set('token', this.token);
        window.location.replace(url.href);
      }
    }

    Cart.fetchCart(this.token);
  },
  methods:{
    remove(product){
      this.loading = true;
      Cart.remove({'id': product.id}, this.handleCartFetched);
    },
    handleCartFetched(){
      this.loading = false;
    }
  }
}
</script>
