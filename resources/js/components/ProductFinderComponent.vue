<template>
  <div :id="(id ? id : '')">
    <div class="form-group">
      <label for="creator_product_term" class="sr-only">Busque el producto</label>
      <div class="d-flex align-items-center justify-content-center">
        <input type="text" v-model="term" @keyup="checkEnter" id="creator_product_term" :disabled="loading" class="form-control" placeholder="ID o Título del producto..." style="max-width: 300px">
        <button type="button" class="btn btn-success ml-4" @click="fetchProducts" :disabled="(term.length < 3 || loading)">Buscar</button>
      </div>
    </div>
    <div v-if="term_searched">

    <div v-if="products.length" style="overflow-y: auto; max-heigth:330px;">
      <p>Se han encontrado <strong>{{ products.length }}</strong> productos para el término <strong>"{{ term_searched }}"</strong></p>
      <table class="table table-sm">
        <thead class="thead-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Título</th>
            <th scope="col">Stock</th>
            <th scope="col">Precio</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products">
            <td scope="row">{{ product.id }}</td>
            <td>{{ product.title }}</td>
            <td>{{ product.validate_stock ? product.stock : '-' }}</td>
            <td><strong>{{ product.price }}€</strong> <small>x {{ product.selling_type == 1 ? 'Unidad' : 'Kilo' }}</small></td>
            <td><button type="button" @click="$emit('select', product)" class="btn btn-sm btn-primary"><i class="fas fa-arrow-right"></i></button></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="alert alert-info" v-if="!products.length">
      No se han encontrado productos para el termino <strong>"{{ term_searched }}"</strong>
    </div>

  </div>
  </div>
</template>

<script>
export default {
  props: ['id'],
  data(){
    return {
      term: '',
      products: [],
      loading: false,
      error: false,
      term_searched: false
    }
  },
  mounted(){
    if(this.id){
      const ProductFinder = document.getElementById(this.id);
      ProductFinder.addEventListener('clean', this.clean);
    }
  },
  methods:{
    fetchProducts(){
      this.loading = true;
      axios.get('/administracion/productos/fetch', {
        params: {
          term: this.term
        }
      })
      .then((response) => {
        this.products = response.data.products;
        this.term_searched = this.term;
      })
      .catch(() => {
        this.error = true;
      })
      .then(() => {
        this.loading = false;
      });
    },
    checkEnter(e){
      if(e.keyCode === 13) {
        e.preventDefault();
        if(this.term.length > 2) this.fetchProducts();
      }
    },
    clean(){
      this.term = '';
      this.products = [];
      this.loading = this.term_searched = this.error = false;
    }
  }
}
</script>
