<template>
  <div class="modal fade" tabindex="-1" role="dialog" backdrop="static" :id="id">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
      <div class="modal-content">
        <div class="modal-header bg-dark text-light">
          <h5 class="modal-title font-weight-bold text-uppercase">Editar Producto <span v-if="product"> - {{ product.data.title.substring(0,30) }}</span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-light">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <product-form v-if="product" :product="product" @save="$emit('save')"/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import OrderProductForm from './OrderProductForm.vue';

export default {
  props:['product', 'id'],
  components:{
    'product-form': OrderProductForm
  }
}
</script>
