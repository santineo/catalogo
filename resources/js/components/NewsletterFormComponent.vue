<template>
  <div>
    <div class="alert alert-danger" v-if="error">
      <div class="d-flex justify-content-between">
        <div>Hubo un error al enviar el email</div>
        <button type="button" @click="error = false" class="btn text-danger"><i class="fas fa-times"></i></button>
      </div>
    </div>
    <div class="alert alert-info text-center" v-if="sended">
      <div style="font-size: 2rem;" class="font-weight-bold">
        Enviado
      </div>
    </div>
    <div class="position-relative" v-if="!sended">
      <loader :loading="loading" :text="'Enviando...'" />
    <div class="form-group">
      <label for="subject">Asunto</label>
      <input type="text" v-model="subject" name="subject" class="form-control">
    </div>
    <product-list :products="products" class="mt-5"></product-list>
    <hr/>
    <email-list :emails="emails" class="mt-4"></email-list>
    <hr />
    <select-list :groups="true" :feed_uri="'/administracion/grupos?limited=1'" label="Grupos" @updated="updateGroups"></select-list>
    <hr />
    <select-list :client="true" :feed_uri="'/administracion/clientes'" label="Clientes" @updated="updateClients"></select-list>
    <hr/>
    <div class="text-right mt-4">
      <button type="button" @click="showPreview" :disabled="!products.length" class="btn btn-success btn-lg">Previsualizar</button>
      <button type="button" @click="send" :disabled="canSend" class="btn btn-primary btn-lg">Enviar</button>
    </div>

    <prev-modal :id="prevId" :preview="preview"></prev-modal>
  </div>

  </div>
</template>

<script>
import PrevModal from './PrevModal.vue';
import ProductList from './ProductListComponent.vue';
import EmailList from './EmailListComponent.vue';
import Loader from './LoaderComponent.vue';
export default {
  components: {
    'email-list': EmailList,
    'product-list': ProductList,
    'prev-modal': PrevModal,
    'loader': Loader
  },
  data(){
    return {
      products: [],
      emails: [],
      clients: [],
      groups: [],
      subject: '',
      preview: false,
      prevId: 'prevModal',
      sended: false,
      loading: false,
      error: false
    }
  },
  computed:{
    canSend(){
      return !(this.products.length && (this.emails.length || this.clients.length || this.groups.length));
    }
  },
  methods:{
    send(){
      axios.post('/administracion/newsletters', {
        emails: this.emails,
        groups: this.groups,
        clients: this.clients,
        products: this.products.map(product => product.id),
        subject: this.subject
      })
      .then((response) => {
        this.sended = response.data.sended;
      })
      .catch((error) => {
        this.error = true;
      })
      .then(() => {
        this.loading = false;
      })
    },
    showPreview(){
      this.prev = false;
      $('#prevModal').modal('show');
      axios.post('/administracion/newsletters/preview', {
        products: this.products.map(product => product.id)
      })
      .then((response) => {
        this.preview = response.data.view;
      })
    },
    updateClients(clients){
      this.clients = clients;
    },
    updateGroups(groups){
      this.groups = groups;
    }
  }
}
</script>

<style lang="css">
</style>
