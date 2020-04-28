<template>
  <div>
    <div v-if="Cart.products.length">

      <div class="text-right border-bottom pb-1">Precio</div>

      <div class="row py-3 border-bottom" v-for="product in Cart.products">
        <div class="col-md-10 d-flex">
          <img :src="product.data.image ? product.data.image.thumb : Cart.getProductNoImage('thumb')" alt="" style="max-width: 125px;">
          <div class="ml-3 pt-1 d-flex flex-column">
            <h5 class="ellipsis-2"><a :href="product.data.public_path" class="font-weight-bold">{{ product.data.title }}</a></h5>
            <div class="small mb-1">Marca: <a :href="getBrandUrl(product.data.brand_id)">{{ product.data.brand.name }}</a></div>
            <div class="small mb-1">Categoría: <a :href="getCategoryUrl(product.data.category.id)">{{ product.data.category.name }}</a></div>
            <div class="d-flex small mt-auto pb-1">
              <div class="pr-3 border-right">
                <span>Cantidad: </span>
                <strong>{{ product.quantity }}</strong>
                <small>{{ product.data.selling_type == 2 ? 'grs.' : '' }}</small>
              </div>
              <div class="px-3 border-right"><a href="javascript: void(0)" @click.prevent="Cart.confirmation(product.id, 'modify')">Modificar</a></div>
              <div class="px-3 border-right"><a href="javascript: void(0)" @click.prevent="Cart.confirmation(product.id, 'destroy')" >Eliminar</a></div>
            </div>
          </div>
        </div>
        <div class="col-md-2 text-right c-red font-weight-bold">
          <div>{{ product.data.price }} €</div>
          <div class="text-right" style="line-height: 0.7;"><small>x {{ product.data.price_type }}</small></div>
        </div>
      </div>

    </div>

    <div v-if="!Cart.products.length" class="alert alert-info">La cesta no contiene productos.</div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      Cart
    }
  },
  methods:{
    getBrandUrl(id){
      return '/products?brand=' + id;
    },
    getCategoryUrl(id){
      return '/products?category=' + id;
    }
  }
}
</script>

<style lang="css">
</style>
