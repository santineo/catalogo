<template>
  <div>
    <div class="mb-2">Cantidad <small>(en {{ orderProduct.getUnityType() }})</small></div>
    <div class="mb-3">
      <div class="d-flex align-items-center">
        <button type="button" @click.prevent="minus" :disabled="!canMinus" class="btn btn-primary btn-sm"><i class="fas fa-minus"></i></button>
        <div class="font-weight-bold mx-3">{{ orderProduct.quantity }}</div>
        <button type="button" @click.prevent="plus" :disabled="!canPlus" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></button>
      </div>
    </div>

    <div class="d-flex align-items-center">
      <button type="button" class="btn btn-success" :disabled="loading" @click.prevent="pushEvent">{{ buttonLabel }}</button>
      <div class="p-3 border bg-light d-inline-block ml-auto">
        Total: <strong>{{ orderProduct.getTotal() }}€</strong>
      </div>
    </div>

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
