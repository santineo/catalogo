<template>
  <modal :id="modalId" :title="'Cesta'">
    <div v-if="product">¿Desea quitar <strong>{{ product.data.title }}</strong> de la cesta?</div>
    <template slot="footer">
      <div class="d-flex">
        <button type="button" class="btn btn-secondary mr-2" :disabled="loading" @click="close">No</button>
        <button type="button" class="btn btn-primary" :disabled="loading" @click="destroy">Si</button>
      </div>
    </template>
  </modal>
</template>

<script>
import ModalComponent from './ModalComponent.vue';
export default {
  props: ['product'],
  components: {
    'modal': ModalComponent
  },
  data(){
    return {
      modalId: Cart.modals.destroy.id,
      loading: false
    }
  },
  mounted(){
    $(`#${this.modalId}`).on('hidden.bs.modal', this.clean);
  },
  methods: {
    close(){
      $(`#${this.modalId}`).modal('hide');
    },
    clean(){
      Cart.modals.destroy.product = false;
    },
    destroy(){
      this.loading = true;
      Cart.remove({'id': this.product.id}, this.handleCartFetched);
    },
    handleCartFetched(){
      this.loading = false;
      this.close();
    }
  }
}
</script>
