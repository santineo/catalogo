<template>
  <div v-if="Cart" class="cart" :class="{'active': active}">
    <a href="javascript: void(0);" @click.prevent="active = !active" class="p-2 bg-light border-top border-left border-bottom cart-link"><span>{{ Cart.products.length }}</span> <i class="fas fa-shopping-cart"></i></a>
    <div class="cart-container bg-light border">
      <div class="text-center font-weight-bold py-2">Productos</div>
      <div style="height: 350px;">
      <div v-for="product in Cart.products" class="d-flex p-2 align-items-center">
        <div class="mr-2">
          <img :src="product.data.image ? product.data.image.small : getProductNoImage('small')" alt="">
        </div>

        <div>
          <small>{{ product.data.title }}</small>
          <div class="d-flex justify-content-between">
            <small>Cantidad: {{ product.quantity + (product.data.selling_type == 2 ? 'grs.' : '')}}</small>
            <small>Precio: {{ product.data.price }}</small>
          </div>
        </div>

        <div class="">
          <a href="javascript:void(0);" class="text-danger d-inline-block ml-3" @click.prevent="remove(product)"><i class="fas fa-times"></i></a>
        </div>
      </div>
    </div>

    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      Cart,
      loading: false,
      active: false
    }
  },
  methods:{
    remove(product){
      this.loading = true;
      Cart.remove({'id': product.id}, this.handleCartFetched);
    },
    handleCartFetched(){
      this.loading = false;
    },
    getProductNoImage(size = 'url'){
      return '/images/no-product-image' + (size != 'url' ? `_${size}` : '') + '.png'
    }
  }
}
</script>

<style lang="scss" scoped>
$cartWidth: 300px;

.cart{
  position: fixed;
  right: -$cartWidth;
  top: 90px;
  transition: all 0.3s ease-in-out;

  &.active{
    right: 0;
  }

  &-link{
    position: absolute;
    left: -71px;
    border-radius: 21px 0px 0px 21px;
    font-size: 2rem;
    display: flex;
    align-items: center;
    span{
      margin-left: 0.5rem;
      font-size: 1rem;
    }
  }

  &-container{
    width: $cartWidth;
  }
}
</style>
