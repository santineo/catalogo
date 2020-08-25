<template>
  <div style="padding-right: 33px;">
    <form method="post" @submit.prevent="onSubmit" @keydown="onKeyDown">

      <h2 class="checkout-form-title">Formulario de Compra</h2>

      <div>
        <h3 class="checkout-form-subtitle">Datos de Contacto</h3>
        <div class="form-group">
          <label for="email" class="sr-only">Email</label>
          <input type="email" name="email" v-model="form.email" class="form-control form-control-rounded" placeholder="Email">
          <span class="text-danger small" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>
        </div>
        <div style="font-size: 14px;"><span style="font-weight: 600;">¿Ya tenes una cuenta?.</span> <a href="/login" class="text-dark">Iniciá sesión</a></div>
      </div>

      <h2 style="text-transform: uppercase; margin-top: 65px; font-size: 20px; font-weight: 600;">Dirección de Entrega</h2>
      <div style="margin-top: 18px;">
        <h3 style="font-size: 14px; font-weight:600; color: #3e3e3e; margin-bottom: 22px;">Datos del Destinatario</h3>

        <div class="form-group">
          <label for="name" class="sr-only">Nombre</label>
          <input type="text"  name="first_name" v-model="form.first_name" class="form-control form-control-rounded" placeholder="Nombre">
          <span class="text-danger small" v-if="form.errors.has('first_name')" v-text="form.errors.get('first_name')"></span>
        </div>

        <div class="form-group">
          <label for="last_name" class="sr-only">Apellido</label>
          <input type="text"  name="last_name" v-model="form.last_name" class="form-control form-control-rounded" placeholder="Apellido">
          <span class="text-danger small" v-if="form.errors.has('last_name')" v-text="form.errors.get('last_name')"></span>
        </div>

        <div class="form-group">
          <label for="phone" class="sr-only">Teléfono</label>
          <input type="text"  name="phone" v-model="form.phone" class="form-control form-control-rounded" placeholder="Teléfono">
          <span class="text-danger small" v-if="form.errors.has('phone')" v-text="form.errors.get('phone')"></span>
        </div>

      </div>

      <div style="margin-top: 46px;">
        <h3 style="font-size: 14px; font-weight:600; color: #3e3e3e; margin-bottom: 22px;">Domicilio del Destinatario</h3>

        <div class="form-group">
          <label for="country" class="sr-only">País</label>
          <input type="text" name="country" v-model="form.country" class="form-control form-control-rounded" disabled placeholder="País">
        </div>

        <div class="form-group">
          <label for="address_street" class="sr-only">Calle</label>
          <input type="text"  name="address_street" v-model="form.address_street" class="form-control form-control-rounded" placeholder="Calle">
          <span class="text-danger small" v-if="form.errors.has('address_street')" v-text="form.errors.get('address_street')"></span>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="number" class="sr-only">Número</label>
              <input type="text"  name="address_number" v-model="form.address_number" class="form-control form-control-rounded" placeholder="Número">
              <span class="text-danger small" v-if="form.errors.has('address_number')" v-text="form.errors.get('address_number')"></span>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="address_dpto" class="sr-only">Dpto</label>
              <input type="text"  name="address_dpto" v-model="form.address_dpto" class="form-control form-control-rounded" placeholder="Dpto">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="city" class="sr-only">Ciudad</label>
              <input type="text"  name="city" v-model="form.city" class="form-control form-control-rounded" placeholder="Ciudad">
              <span class="text-danger small" v-if="form.errors.has('city')" v-text="form.errors.get('city')"></span>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="zip_code" class="sr-only">Código Postal</label>
              <input type="text"  name="zip_code" v-model="form.zip_code" class="form-control form-control-rounded" placeholder="Código Postal">
              <span class="text-danger small" v-if="form.errors.has('zip_code')" v-text="form.errors.get('zip_code')"></span>
            </div>
          </div>
        </div>


        <div class="form-group">
          <label for="locality" class="sr-only">Localidad</label>
          <input type="text"  name="locality" v-model="form.locality" class="form-control form-control-rounded" placeholder="Localidad">
          <span class="text-danger small" v-if="form.errors.has('locality')" v-text="form.errors.get('locality')"></span>
        </div>

      </div>

      <div class="text-right" style="margin-top: 64px;">
        <button type="submit" class="btn btn-secondary" style="font-size: 13px; font-weight: 600; text-transform: uppercase; border-radius: 50px; padding: 15px 104px;">Continuar</button>
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
        email: '',
        first_name: '',
        last_name: '',
        phone: '',
        country: 'Argentina',
        address_street: '',
        address_number: '',
        address_dpto: '',
        city: '',
        zip_code: '',
        locality: ''
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
