<template>
  <div class="cart-products">
    <div v-if="!emptyCart">

      <h2 class="cart-products-title">Carrito</h2>
      <div class="row cart-products-headers">
        <div class="col-7">Productos</div>
        <div class="col-2 text-center">Cantidad</div>
        <div class="col-2 text-center">Precio</div>
        <div class="col-1"></div>
      </div>
      <div class="position-relative">
        <loader :loading="Cart.loading"></loader>
        <div class="row align-items-center cart-products-row" v-if="Cart.products.length" v-for="product in Cart.products">

          <div class="col-7">
            <div class="d-flex align-items-center">
              <div :style="`background-image: url(${product.data.image ? product.data.image.thumb : Cart.getProductNoImage('thumb')})`" class="position-relative cart-products-row-image"></div>
              <div>
                <h3 class="cart-products-row-title">{{ product.data.title }}</h3>
                <div class="cart-products-row-id">#{{ product.data.id }}</div>
              </div>
            </div>
          </div>

          <div class="col-2">

            <product-checkout v-if="product" :product="product.data" :quantity="product.quantity" :callback="close" :sync="true" />

          </div>

          <div class="col-2 text-center">
            <div class="cart-products-row-price">{{ product.data.formatted_price }}</div>
          </div>

          <div class="col-1 text-right">
            <a href="javascript: void(0)" class="cart-products-row-close" @click.prevent="Cart.confirmation(product.id, 'destroy')"><i class="fas fa-times"></i></a>
          </div>
        </div>

      </div>

    </div>

    <alert v-if="emptyCart" :show="true" title="No se han agregado productos a la cesta" message="Busca en nuestros <a href='/productos'>productos</a> lo que deseas comprar."></alert>

  </div>
</template>

<script>
import Loader from '../components/LoaderComponent.vue';
export default {
  data(){
    return {
      Cart
    }
  },
  components:{
    'loader': Loader
  },
  computed:{
    emptyCart(){
      return !Cart.loading && !Cart.products.length;
    }
  },
  methods:{
    getBrandUrl(id){
      return '/products?brand=' + id;
    },
    getCategoryUrl(id){
      return '/products?category=' + id;
    }
  }
}
</script>
