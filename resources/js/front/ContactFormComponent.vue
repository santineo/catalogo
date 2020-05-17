<template>
  <div v-if="!contact">
    <h2 class="mb-3">Contacto</h2>
    <div class="position-relative card rounded-0  px-3 py-4" >
      <loader :loading="loading"></loader>
      <form method="post" @submit.prevent="onSubmit" @keydown="onKeyDown">
        <div class="row">
          <div class="form-group col-sm-6">
            <label for="name">Nombre<span class="text-danger">*</span></label>
            <input type="text" name="name" v-model="form.name" class="form-control">
            <span class="text-danger small" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
          </div>
          <div class="form-group col-sm-6">
            <label for="email">Email<span class="text-danger">*</span></label>
            <input type="email" name="email" v-model="form.email" class="form-control">
            <span class="text-danger small" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>
          </div>
          <div class="form-group col-sm-6">
            <label for="phone">Teléfono</label>
            <input type="text" name="phone" v-model="form.phone" class="form-control">
            <span class="text-danger small" v-if="form.errors.has('phone')" v-text="form.errors.get('phone')"></span>
          </div>
          <div class="form-group col-sm-12">
            <label for="message">Mensaje<span class="text-danger">*</span></label>
            <textarea name="message" v-model="form.message" class="form-control" rows="6"></textarea>
            <span class="text-danger small" v-if="form.errors.has('message')" v-text="form.errors.get('message')"></span>
          </div>
          <div class="text-right col-sm-12">
            <button type="submit" class="btn btn-large btn-primary">Envíar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Form from '../classes/Form';

export default {
  data(){
    return {
      form: new Form({
        name: '',
        phone: '',
        email: '',
        message: ''
      }),
      loading: false,
      contact: false
    }
  },
  methods:{
    onKeyDown(e){
      this.form.errors.clear(e.target.name)
    },
    onSubmit(){
      this.loading = true;
      this.form.post('/contacto')
      .then((response) => {
        this.contact = response.contact;
        if(this.contact) Alert.open('info', `Nos contactaremos a la brevedad al emai <strong>${this.contact.email}</strong>.`, 'Su mensaje ha sido enviado');
      })
      .catch((error) => {
        if(error.status == 500) Alert.open('danger', 'Por favor, refresque la página e intentelo de nuevo', 'Ha ocurrido un error');
        console.log(error);
      })
      .then(() => {
        this.loading = false;
      });
    },
  }
}
</script>
