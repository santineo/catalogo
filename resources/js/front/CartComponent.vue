<template>
  <div v-if="(Cart && !token)">
    <div class="cart d-none d-md-block" v-show="show">
      <a href="/cart" class="p-2 bg-light border-top border-left border-bottom cart-link"><span :class="{'invisible': !Cart.created}">{{ Cart.products.length }}</span> <i class="fas fa-shopping-cart"></i></a>
    </div>
    <destroy-product :product="Cart.modals.destroy.product" />
    <modify-product :product="Cart.modals.modify.product" />
  </div>
</template>

<script>
import DestroyProductCart from './DestroyProductCart.vue';
import ModifyProductCart from './ModifyProductCart.vue';
export default {
  props: ['token', 'show'],
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

<style lang="scss" scoped>

.cart{
  position: fixed;
  top: 90px;
  right: 0;

  &-link{
    position: absolute;
    left: -80px;
    border-radius: 21px 0px 0px 21px;
    font-size: 2rem;
    display: flex;
    align-items: center;
    color: #555;

    span{
      margin: 0 0.5rem;
      font-size: 1.25rem;
    }

    &:hover{
      text-decoration: none;
    }
  }
  .invisible{
    visibility: hidden;
  }

}
</style>
