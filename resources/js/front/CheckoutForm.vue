<template>
  <div style="padding-right: 33px;">
    <form method="post" @submit.prevent="onSubmit" @keydown="onKeyDown">

      <h2 style="text-transform: uppercase; margin-bottom: 51px;font-size: 20px; font-weight: 600;">Formulario de Compra</h2>

      <div>
        <h3 style="font-size: 14px; font-weight:600; color: #3e3e3e; margin-bottom: 22px;">Datos de Contacto</h3>
        <div class="form-group" style="margin-bottom: 25px;">
          <label for="email" class="sr-only">Email</label>
          <input type="email" name="email" v-model="form.email" class="form-control" placeholder="Email" style="border-radius: 30px; height: 49px; padding-left: 28px; font-size: 13px;">
          <span class="text-danger small" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>
        </div>
        <div style="font-size: 14px;"><span style="font-weight: 600;">¿Ya tenes una cuenta?.</span> <a href="/login" class="text-dark">Iniciá sesión</a></div>
      </div>

      <h2 style="text-transform: uppercase; margin-top: 65px; font-size: 20px; font-weight: 600;">Dirección de Entrega</h2>
      <div style="margin-top: 18px;">
        <h3 style="font-size: 14px; font-weight:600; color: #3e3e3e; margin-bottom: 22px;">Datos del Destinatario</h3>

        <div class="form-group" style="margin-bottom: 16px;">
          <label for="name" class="sr-only">Nombre</label>
          <input type="text"  name="name" v-model="form.name" class="form-control" placeholder="Nombre" style="border-radius: 30px; height: 49px; padding-left: 28px; font-size: 13px;">
          <span class="text-danger small" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
        </div>

        <div class="form-group" style="margin-bottom: 16px;">
          <label for="last_name" class="sr-only">Apellido</label>
          <input type="text"  name="last_name" v-model="form.last_name" class="form-control" placeholder="Apellido" style="border-radius: 30px; height: 49px; padding-left: 28px; font-size: 13px;">
          <span class="text-danger small" v-if="form.errors.has('last_name')" v-text="form.errors.get('last_name')"></span>
        </div>

        <div class="form-group" style="margin-bottom: 16px;">
          <label for="phone" class="sr-only">Teléfono</label>
          <input type="text"  name="phone" v-model="form.phone" class="form-control" placeholder="Teléfono" style="border-radius: 30px; height: 49px; padding-left: 28px; font-size: 13px;">
          <span class="text-danger small" v-if="form.errors.has('phone')" v-text="form.errors.get('phone')"></span>
        </div>

      </div>

      <div style="margin-top: 46px;">
        <h3 style="font-size: 14px; font-weight:600; color: #3e3e3e; margin-bottom: 22px;">Domicilio del Destinatario</h3>

        <div class="form-group" style="margin-bottom: 16px;">
          <label for="country" class="sr-only">País</label>
          <input type="text" name="country" v-model="form.country" class="form-control" value="Argentina" disabled placeholder="País" style="border-radius: 30px; height: 49px; padding-left: 28px; font-size: 13px;">
        </div>

        <div class="form-group" style="margin-bottom: 16px;">
          <label for="street" class="sr-only">Calle</label>
          <input type="text"  name="street" v-model="form.street" class="form-control" placeholder="Calle" style="border-radius: 30px; height: 49px; padding-left: 28px; font-size: 13px;">
          <span class="text-danger small" v-if="form.errors.has('street')" v-text="form.errors.get('street')"></span>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group" style="margin-bottom: 16px;">
              <label for="number" class="sr-only">Número</label>
              <input type="text"  name="number" v-model="form.number" class="form-control" placeholder="Número" style="border-radius: 30px; height: 49px; padding-left: 28px; font-size: 13px;">
              <span class="text-danger small" v-if="form.errors.has('number')" v-text="form.errors.get('number')"></span>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group" style="margin-bottom: 16px;">
              <label for="dpto" class="sr-only">Dpto</label>
              <input type="text"  name="dpto" v-model="form.dpto" class="form-control" placeholder="Dpto" style="border-radius: 30px; height: 49px; padding-left: 28px; font-size: 13px;">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group" style="margin-bottom: 16px;">
              <label for="city" class="sr-only">Ciudad</label>
              <input type="text"  name="city" v-model="form.city" class="form-control" placeholder="Ciudad" style="border-radius: 30px; height: 49px; padding-left: 28px; font-size: 13px;">
              <span class="text-danger small" v-if="form.errors.has('city')" v-text="form.errors.get('city')"></span>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group" style="margin-bottom: 16px;">
              <label for="cp" class="sr-only">Código Postal</label>
              <input type="text"  name="cp" v-model="form.cp" class="form-control" placeholder="Código Postal" style="border-radius: 30px; height: 49px; padding-left: 28px; font-size: 13px;">
              <span class="text-danger small" v-if="form.errors.has('cp')" v-text="form.errors.get('cp')"></span>
            </div>
          </div>
        </div>


        <div class="form-group" style="margin-bottom: 16px;">
          <label for="locality" class="sr-only">Localidad</label>
          <input type="text"  name="locality" v-model="form.locality" class="form-control" placeholder="Localidad" style="border-radius: 30px; height: 49px; padding-left: 28px; font-size: 13px;">
          <span class="text-danger small" v-if="form.errors.has('locality')" v-text="form.errors.get('locality')"></span>
        </div>

      </div>

      <div class="text-right" style="margin-top: 64px;">
        <button type="button" class="btn btn-secondary" style="font-size: 13px; font-weight: 600; text-transform: uppercase; border-radius: 50px; padding: 15px 104px;">Continuar</button>
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
        name: '',
        last_name: '',
        phone: '',
        country: '',
        street: '',
        number: '',
        dpto: '',
        city: '',
        cp: '',
        localit: ''
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
