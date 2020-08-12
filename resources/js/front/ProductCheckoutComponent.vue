<template>
  <div>
    <div class="text-dark" style="font-size: 12px;line-height: 1.5; margin-bottom: 45px;">
      <div style="margin-bottom: 15px;">Cantidad</div>
      <div class="d-inline-block border">
        <div class="d-flex align-items-center" style="font-weight: 600; padding: 6px 11px">
          <button type="button" @click.prevent="minus" :disabled="!canMinus" style="width: 23px; height: 23px;" class="bg-dark text-white d-flex align-items-center justify-content-center">-</button>
          <div style="padding: 0 17px;">{{ orderProduct.quantity }}</div>
          <button type="button" @click.prevent="plus" :disabled="!canPlus" style="width: 23px; height: 23px;" class="bg-dark text-white d-flex align-items-center justify-content-center">+</button>
        </div>
      </div>
    </div>

    <button type="button" class="btn btn-secondary btn-lg text-white text-uppercase" style="font-size: 13px; font-weight: 600; padding: 15px 53px; border-radius: 50px;":disabled="loading" @click.prevent="pushEvent">Agregar Carrito</button>


  </div>
</template>

<script>
import Product from '../classes/Product';
export default {
  props: ['product', 'quantity', 'callback', 'action'],
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
    buttonLabel(){
      return this.quantity ? 'Modificar': 'Agregar';
    },
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
    },
    plus(){
      if(this.validateMax()) this.orderProduct.quantity = this.orderProduct.quantity + this.step;
    },
    pushEvent(){
      this.loading = true;
      Cart[this.action ? this.action : 'add'](this.orderProduct.getFormFormat(), this.handleCartResponse);
    },
    handleCartResponse(){
      this.loading = false;
      if(this.callback) this.callback();
    }
  }
}
</script>

<style lang="css">
</style>
