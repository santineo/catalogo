<template>
  <div>
    <div class="h3 mb-3">Productos</div>
    <div class="position-relative">
      <loader :loading="loading" />
      <div class="mb-3">
        <order-product-card v-if="products.length" @edit="edit(product)" v-for="(product, index) in products" :key="product.id" @delete="deleteProduct(index)" :product="product" />
        <div class="alert alert-info" v-if="!products.length">El pedido no contiene productos.</div>
      </div>
      <div class="text-right">
        <button type="button" @click="openModal(creatorModal)" class="btn btn-primary">Agregar Producto</button>
      </div>
      <order-product-creator :id="creatorModal" @create="createProduct"/>
      <order-product-editor :id="editorModal" @save="closeModal(editorModal)" :product="productToEdit"/>
    </div>

  </div>
</template>

<script>
import OrderProductCardComponent from './OrderProductCardComponent.vue';
import OrderProductCreatorComponent from './OrderProductCreatorComponent.vue';
import OrderProductEditorComponent from './OrderProductEditorComponent.vue';
import Product from '../classes/Product';
import LoaderComponent from './LoaderComponent';

export default {
  props: ['order_id', 'products', 'order_products'],
  components:{
    'order-product-card': OrderProductCardComponent,
    'order-product-creator': OrderProductCreatorComponent,
    'order-product-editor': OrderProductEditorComponent,
    'loader': LoaderComponent
  },
  data(){
    return {
      creatorModal: 'modalCreator',
      editorModal: 'modalEditor',
      loading: false,
      error: false,
      productToEdit: false
    }
  },
  created(){
    if(this.order_products) {
      this.setProducts(this.order_products);
    }else{
      this.fetchProducts();
    }
  },
  mounted(){
    $(`#${this.editorModal}`).on('bs.hidden.modal', () => {
      this.productToEdit = false;
    });
  },
  methods: {
    openModal(modalId){
      $(`#${modalId}`).modal('show');
    },
    closeModal(modalId){
      $(`#${modalId}`).modal('hide');
    },
    createProduct(product){
      this.products.push(product);
      this.closeModal(this.creatorModal);
      document.dispatchEvent((new Event('form_changed')));
    },
    setProducts(products){
      products.forEach((product) => {
        this.products.push(new Product(product));
      });
    },
    fetchProducts(){
      if(!this.order_id) return;
      this.loading = true;
      axios.get(`/administracion/pedidos/${this.order_id}/productos`)
      .then((response) => {
        this.setProducts(response.data.products);
      })
      .catch((error) => {
        this.error = true;
      })
      .then(() => {
        this.loading = false;
      })
    },
    edit(product){
      this.productToEdit = product;
      this.openModal(this.editorModal);
    },
    deleteProduct(index){
      this.products.splice(index, 1);
    }
  }
}
</script>
