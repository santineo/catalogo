<template>
  <div>
    <div v-if="Cart.products.length">

      <h2 style="margin-bottom: 66px; font-size: 20px; font-weight:600;" class="text-dark">Carrito</h2>
      <div class="row" style="font-size: 14px; color: #c1c1c1; margin-bottom: 40px;">
        <div class="col-7">Productos</div>
        <div class="col-2 text-center">Cantidad</div>
        <div class="col-2 text-center">Precio</div>
        <div class="col-1"></div>
      </div>

      <div class="row align-items-center" style="margin-bottom: 38px;" v-for="product in Cart.products">

        <div class="col-7">
          <div class="d-flex align-items-center">
            <div style="width: 71px; height: 71px; border-radius: 100%; overflow: hidden; background-position: center center; background-repeat: no-repeat; background-size: 100%" :style="`background-image: url(${product.data.image ? product.data.image.thumb : Cart.getProductNoImage('thumb')})`" class="position-relative"></div>
            <div style="margin-left:50px">
              <h3 style="font-size: 16px;font-weight: 600;" class="mb-1">{{ product.data.title }}</h3>
              <div style="color: #c4c4c4; font-size:13px; font-weight: 300;">#{{ product.data.id }}</div>
            </div>
          </div>
        </div>

        <div class="col-2">
          <div class="text-dark text-center" style="font-size: 16px;line-height: 1.5;">
            <div class="d-inline-block border" style="border-radius: 50px;">
              <div class="d-flex align-items-center" style=" padding: 13px 30px">
                <div class="text-dark" style="font-size: 20px">-</div>
                <div style="padding: 0 21px;font-weight: 600;">1</div>
                <div class="text-dark" style="font-size: 20px">+</div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-2 text-center">
          <div style="font-weight: 600; font-size: 16px;">${{ product.data.price.toFixed(2) }}</div>
        </div>

        <div class="col-1 text-right">
          <a href="javascript: void(0)" class="text-dark" style="font-size: 20px" @click.prevent="Cart.confirmation(product.id, 'destroy')"><i class="fas fa-times"></i></a>
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
