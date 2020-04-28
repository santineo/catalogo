<template>
  <modal :id="modalId" hide_footer="true" :title="'Cesta'">
    <product-checkout v-if="product" :product="product.data" :quantity="product.quantity" :callback="close" :action="'update'" />
  </modal>
</template>

<script>
import ProductCheckoutComponent from './ProductCheckoutComponent.vue';
import ModalComponent from './ModalComponent.vue';
import Product from '../classes/Product';
export default {
  props: ['product'],
  components: {
    'modal': ModalComponent,
    'product-checkout': ProductCheckoutComponent
  },
  data(){
    return {
      modalId: Cart.modals.modify.id,
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
      Cart.modals.modify.product = false;
    }
  }
}
</script>
