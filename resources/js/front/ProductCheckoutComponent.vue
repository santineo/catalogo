<template>
  <div class="product-article-checkout">

    <div class="product-article-checkout-quantity" :class="{'mb-0': sync}">
      <div class="product-article-checkout-quantity-title" v-if="label_quantity">{{ label_quantity }}</div>

        <div class="d-inline-block border" v-if="!sync">
          <div class="product-article-checkout-quantity-box">
            <button type="button" @click.prevent="minus" :disabled="!canMinus">
              <i class="icon icon-minus"></i>
            </button>
            <div class="product-article-checkout-quantity-box-number">{{ orderProduct.quantity }}</div>
            <button type="button" @click.prevent="plus" :disabled="!canPlus">
              <i class="icon icon-plus"></i>
            </button>
          </div>
        </div>

        <div class="cart-products-row-quantity" v-if="sync">
          <div class="cart-products-row-quantity-box">
            <div class="d-flex align-items-center">
              <button type="button" @click.prevent="minus" :disabled="!canMinus" class="cart-products-row-quantity-box-minus"><i class="icon icon-minus"></i></button>
              <div class="cart-products-row-quantity-box-number">{{ orderProduct.quantity }}</div>
              <button type="button" @click.prevent="plus" :disabled="!canPlus" class="cart-products-row-quantity-box-plus"><i class="icon icon-plus"></i></button>
            </div>
          </div>
        </div>

    </div>

    <button type="button" v-if="!sync" class="btn btn-secondary text-white btn-rounded btn-rounded-lg" :disabled="loading" @click.prevent="pushEvent">{{ label_button ? label_button : 'Agregar Carrito'}}</button>

  </div>
</template>

<script>
import Product from '../classes/Product';
export default {
  props: ['product', 'quantity', 'callback', 'action', 'label_quantity', 'label_button', 'sync'],
  data(){
    return {
      step: this.product.selling_type == 1 ? 1 : 25,
      loading: false,
      orderProduct: new Product(this.product, this.quantity)
    }
  },
  created(){
    if(!this.quantity) this.orderProduct.quantity = this.step;
  },
  computed:{
    canPlus(){
      return this.validateMax();
    },
    canMinus(){
      return this.validateMin();
    }
  },
  methods:{
    validateMax(){
      const newQuantity = this.orderProduct.quantity + this.step;
      return (this.orderProduct.data.validate_stock && newQuantity <= this.orderProduct.data.stock) || !this.orderProduct.data.validate_stock;
    },
    validateMin(){
      const newQuantity = this.orderProduct.quantity - this.step;
      return newQuantity > 0;
    },
    minus(){
      if(this.validateMin()) this.orderProduct.quantity = this.orderProduct.quantity - this.step;
      if(this.sync) this.timeoutUpdate();
    },
    plus(){
      if(this.validateMax()) this.orderProduct.quantity = this.orderProduct.quantity + this.step;
      if(this.sync) this.timeoutUpdate();
    },
    pushEvent(){
      this.loading = true;
      Cart[this.action ? this.action : 'add'](this.orderProduct.getFormFormat(), this.handleCartResponse);
    },
    timeoutUpdate(){
      Cart['update'](this.orderProduct.getFormFormat(), this.handleCartResponse);
    },
    handleCartResponse(){
      this.loading = false;
      if(this.callback) this.callback();
    }
  }
}
</script>
