<template>
  <div>
    <h3 class="mb-4">Productos del email</h3>
    <div class="row justify-content-between">
      <div class="col-4">
        <div class="alert alert-danger" v-if="error">
          Se ha producido un error, actualice la página e intente de nuevo.
        </div>
        <div class="form-group">
          <model-list-select
          :list="filterOptions"
          v-model="product"
          option-value="id"
          option-text="title"
          :placeholder="'Seleccione un producto'">
        </model-list-select>

        <div class="mt-3" v-if="(product && product.id)">
          <div class="card rounded-0" >
            <div class="card-body">
              <img v-if="product.image" :src="product.image.thumb" alt="">
              <div class="mt-2 font-weight-bold" style="font-size: 0.8rem">{{ product.title }}</div>
              <div class="mt-2 text-right c-red font-weight-bold" style="font-size: 1rem"><span class="py-2 px-3 bg-warning text-dark">€{{ product.price }}</span></div>
            </div>
          </div>
          <div class="text-right">
            <button type="button" class="btn btn-success btn-sm mt-3" @click="addProduct"><span>Agregar al Email</span> <i class="fas fa-arrow-right ml-2"></i></button>
          </div>
        </div>

      </div>
    </div>
    <div class="col-6">
      <div v-if="products.length">
        <ul class="list-group">
          <li v-for="(emailProduct, index) in products" :key="emailProduct.id" class="d-flex align-items-center list-group-item">
            <strong>{{ emailProduct.title }}</strong>
            <button class="ml-auto btn btn-sm btn-danger" type="button" @click="products.splice(index, 1)"><i class="fas fa-times"></i></button>
          </li>
        </ul>
      </div>
      <div v-if="!products.length" class="alert alert-info">
        No se han agregado productos al email
      </div>
    </div>
  </div>
</div>
</template>

<script>
import 'vue-search-select/dist/VueSearchSelect.css';
import { ModelListSelect } from 'vue-search-select';
export default {
  components: {
    ModelListSelect
  },
  props: ['products'],
  data(){
    return {
      options: [],
      product: {},
      loading: true,
      error: false
    }
  },
  created(){
    this.fetchProducts();
  },
  computed:{
    filterOptions(){
      return this.options.filter(option => !this.products.find(product => product.id == option.id));
    }
  },
  methods:{
    fetchProducts(){
      this.loading = true;
      axios.get('/administracion/productos')
      .then((response) => {
        this.options = response.data.products;
      })
      .catch(() => {
        this.error = true;
      })
      .then(() => {
        this.loading = false;
      })
    },
    addProduct(){
      this.products.push(this.product);
      this.product = {};
    }
  }

}
</script>
