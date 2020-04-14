<template>
  <div class="modal fade" tabindex="-1" role="dialog" backdrop="static" :id="id">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
      <div class="modal-content">
        <div class="modal-header bg-dark text-light">
          <h5 class="modal-title font-weight-bold text-uppercase">Agregar Producto <span v-if="product"> - {{ product.data.title.substring(0,30) }}</span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-light">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <product-finder :id="productFinderId" v-show="!product" @select="select" />
          <div v-if="product">
            <button class="btn btn-lg p-0 mb-3" style="line-height:1" type="button" @click="product = false"><i class="fas fa-arrow-left"></i><span class="ml-2">Productos</span></button>
            <product-form :product="product" @save="$emit('create', product)"/>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import OrderProductForm from './OrderProductForm.vue';
import ProductFinderComponent from './ProductFinderComponent.vue';
import Product from '../classes/Product';

export default {
  props: ['id'],
  components: {
    'product-finder': ProductFinderComponent,
    'product-form': OrderProductForm
  },
  data(){
    return {
      productFinderId: 'creatorProductFinder',
      product: false,
    }
  },
  mounted(){
    $(`#${this.id}`).on('hidden.bs.modal', this.clean);
  },
  methods: {
    clean(){
      const ProductFinder = document.getElementById(this.productFinderId);
      this.product = false;
      ProductFinder.dispatchEvent((new CustomEvent('clean')));
    },
    select(product){
      this.product = new Product(product);
    }
  }
}
</script>
