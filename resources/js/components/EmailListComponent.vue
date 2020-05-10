<template>
  <div>
    <h3 class="mb-4">Destinatarios del email</h3>
    <div class="row justify-content-between">
      <div class="col-4">

        <div class="alert alert-warning" v-if="error">
          <div class="d-flex align-items-center">
            <div>{{ this.error }}</div>
            <button type="button" @click="error = false" class="ml-auto btn text-danger"><i class="fas fa-times"></i></button>
          </div>
        </div>

        <div class="d-flex">
          <div class="form-group">
            <label for="addEmail" class="sr-only">Email</label>
            <input type="text" v-model="newEmail" class="form-control" placeholder="email@gmail.com" @keyup="onKeyUp">
          </div>
          <div class="ml-2">
            <button type="button" class="btn btn-primary" :disabled="!newEmail" @click="addEmail">Agregar</button>
          </div>
        </div>
      </div>

      <div class="col-6">
        <div class="alert alert-info" v-if="!emails.length">
          Aún no se han agregado destinatarios para el email.
        </div>

        <div v-if="emails.length">
          <ul class="list-group">
            <li v-for="(email, index) in emails" :key="index" class="d-flex list-group-item align-items-center">
              <div>{{ email }}</div>
              <button class="ml-auto btn btn-sm btn-danger" type="button" @click="emails.splice(index, 1)"><i class="fas fa-times"></i></button></li>
            </li>
          </ul>
        </div>
      </div>

    </div>
  </div>
</div>
</template>

<script>
export default {
  props: ['emails'],
  data(){
    return {
      newEmail: '',
      error: false
    }
  },
  methods:{
    validateEmail(email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(String(email).toLowerCase());
    },
    addEmail(){
      if(!this.validateEmail(this.newEmail)) {
        this.error = 'El email que ingresó es invalido, revise que sea un email lo que esta intentando agregar';
        return
      }

      if(this.emails.find(email => email == this.newEmail)){
        this.error = 'El email que intentó agregar ya estaba incluido en la lista.';
        return
      }

      this.emails.push(this.newEmail);
      this.error = false;
      this.newEmail = '';
    },
    onKeyUp(e){
      if(!this.newEmail) return;
      if(e.keyCode === 13) this.addEmail();
    }
  }
}
</script>
