<template>
  <form @submit.prevent="onSubmit" @keydown="onKeyDown">
    <loader :loading="loading" />
    <div class="row">
      <div class="form-group col-sm-6">
        <label for="name">Nombre*</label>
        <input type="text" name="name" class="form-control" v-model="form.name">
        <span class="text-danger small" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
      </div>

      <div class="form-group col-sm-6">
        <label for="email">Email*</label>
        <input type="email" name="email" class="form-control" v-model="form.email">
        <span class="text-danger small" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>
      </div>

      <div class="form-group col-sm-6">
        <label for="address">Dirección*</label>
        <input type="text" name="address" class="form-control" v-model="form.address">
        <span class="text-danger small" v-if="form.errors.has('address')" v-text="form.errors.get('address')"></span>
      </div>

      <div class="form-group col-sm-6">
        <label for="phone">Teléfono*</label>
        <input type="text" name="phone" class="form-control" v-model="form.phone">
        <span class="text-danger small" v-if="form.errors.has('phone')" v-text="form.errors.get('phone')"></span>
      </div>

      <div class="form-group col-sm-12">
        <label for="additional_info">Información Adicional</label>
        <textarea name="additional_info" v-model="form.additional_info" id="additional_info" class="form-control" rows="3" cols="80"></textarea>
        <span class="text-danger small" v-if="form.errors.has('additional_info')" v-text="form.errors.get('additional_info')"></span>
      </div>
      <div class="form-group col-sm-2">
        <label for="status">Estado</label>
        <select class="custom-select" name="status" id="status" v-model="form.status">
          <option value="1">Pendiente</option>
          <option value="2">Aceptado</option>
          <option value="3">Entregado</option>
          <option value="4">Cancelado</option>
        </select>
      </div>
    </div>
    <div>
    <order-product-manager :products="products" :order_products="order ? order.products : false" />
    <span class="text-danger small" v-if="form.errors.has('products')" v-text="form.errors.get('products')"></span>
  </div>

    <button type="submit" class="btn btn-success mt-2">{{ submitButtonLabel }}</button>
  </form>

</template>

<script>
import OrderProductManagerComponent from './OrderProductManagerComponent.vue';
import Form from '../classes/Form';
import LoaderComponent from './LoaderComponent.vue';

export default {
  props: ['mode', 'form_action', 'order'],
  components:{
    'order-product-manager': OrderProductManagerComponent,
    'loader': LoaderComponent
  },
  data(){
    return {
      submitButtonLabel: this.mode == 'create' ? 'Crear' : 'Guardar',
      loading: false,
      products: [],
      form: new Form({
        name: this.order ? this.order.name : '',
        email: this.order ? this.order.email : '',
        address: this.order ? this.order.address : '',
        phone: this.order ? this.order.phone : '',
        additional_info: this.order ? this.order.additional_info : '',
        status: this.order ? this.order.status : 1,
        products: []
      })
    }
  },
  methods:{
    setFormProducts(){
      this.form.products = this.products.map(product => product.getFormFormat());
    },
    onSubmit(){
      this.loading = true;
      this.setFormProducts();
      this.form[this.mode == 'create' ? 'post' : 'put'](this.form_action)
      .then((response) => {
        console.log('Fine');
      })
      .catch((error) => {
        console.log(error);
      })
      .then(() => {
        this.loading = false;
      })
    },
    onKeyDown(e){
      if(e.keyCode == 13 && e.target.tagName != 'TEXTAREA'){
         e.preventDefault();
         return false;
       }
      this.form.errors.clear(e.target.name)
    }
  }
}
</script>
