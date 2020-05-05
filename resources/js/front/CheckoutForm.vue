<template>
  <div>
    <form method="post" @submit.prevent="onSubmit" @keydown="onKeyDown">
    <h3>Tus datos</h3>
    <div class="card rounded-0 px-3 py-4">

      <div class="form-group col-sm-12 text-center mt-4 mb-5">
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="ship_method_local" name="ship_method" value="1" v-model="form.ship_method" class="custom-control-input">
          <label class="custom-control-label" for="ship_method_local">Retirar por el local</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="ship_method_address" name="ship_method" value="2" v-model="form.ship_method" class="custom-control-input">
          <label class="custom-control-label" for="ship_method_address">Envío a domicilio</label>
        </div>
      </div>
      <div class="row">

        <div class="form-group col-sm-6">
          <label for="name">Nombre*</label>
          <input type="text" name="name" v-model="form.name" class="form-control">
          <span class="text-danger small" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
        </div>

        <div class="form-group col-sm-6">
          <label for="email">Email*</label>
          <input type="email" name="email" v-model="form.email" class="form-control">
          <span class="text-danger small" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>
        </div>

        <div class="form-group col-sm-6" v-if="form.ship_method == 2">
          <label for="address">Dirección*</label>
          <input type="text" v-model="form.address" name="address" class="form-control">
          <span class="text-danger small" v-if="form.errors.has('address')" v-text="form.errors.get('address')"></span>
        </div>

        <div class="form-group col-sm-6" v-if="form.ship_method == 2">
          <label for="phone">Teléfono*</label>
          <input type="text" v-model="form.phone" name="phone" class="form-control">
          <span class="text-danger small" v-if="form.errors.has('phone')" v-text="form.errors.get('phone')"></span>
        </div>

        <div class="form-group col-sm-12">
          <label for="additional_info">Información Adicional</label>
          <textarea name="additional_info" v-model="form.additional_info" id="additional_info" class="form-control" rows="3" cols="80"></textarea>
          <span class="text-danger small" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
        </div>

      </div>

    </div>

    <div class="text-center text-sm-right mt-3">
      <button type="submit" class="btn btn-primary">Pedir</button>
    </div>
  </form>
  </div>
</template>

<script>
import Form from '../classes/Form';
export default {
  data(){
    return {
      form: new Form({
        name: '',
        email: '',
        address: '',
        phone: '',
        additional_info: '',
        ship_method: 1
      }, this.getToken),
      loading: false,
      sended: false
    }
  },
  methods:{
    getToken(){
      return { token: Cart.token };
    },
    onSubmit(){
      this.loading = true;
      this.form.post('/checkout')
      .then((response) => {
        if(response.status != 'ok') return Alert.open('danger', 'Por favor, refresque la página e intentelo de nuevo', 'Ha ocurrido un error');
        this.sended = true;
        Alert.open('success', `Se le ha enviado un email a ${response.order.email} con el detalle de su pedido.`, '¡Su pedido se ha realizado con éxito!');
        Cart.setCart([]);
      })
      .catch((error) => {
        if(error.status == 500) Alert.open('danger', 'Por favor, refresque la página e intentelo de nuevo', 'Ha ocurrido un error');
        console.log(error);
      })
      .then(() => {
        this.loading = false;
      });
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

<style lang="css">
</style>
