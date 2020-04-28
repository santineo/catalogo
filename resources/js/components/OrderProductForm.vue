<template>
  <div class="row">
    <div class="col-md-8">
      <div class="card border-bottom-0">
        <div class="row no-gutters">
          <div class="col-md-4">
            <img :src="product.data.image ? product.data.image.thumb : 'about:blank'" class="card-img-top" width="180" height="180" alt="">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h4 class="card-title">{{ product.data.title }}</h4>
              <p class="card-text">{{ product.data.description }}</p>
            </div>
          </div>
          <div class="col-md-6 border bg-light p-2 d-flex justify-content-between">
            <div>Precio:</div>
            <div class="font-weight-bold">{{ product.data.price }}€ <small>x {{ product.data.price_type }}</small></div>
          </div>
          <div class="col-md-6 border bg-light p-2 d-flex justify-content-between">
            <div>Stock:</div>
            <div class="font-weight-bold">{{ product.validate_stock ? product.stock : 'Libre' }}</div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-4">
      <div class="form-group">
        <label for="quantity">Cantidad</label>
        <div class="input-group mb-3">
          <input class="form-control" type="number" min="0" :step="quantityStep" v-model="quantity" aria-describedby="quantity-type">
          <div class="input-group-append">
            <span class="input-group-text" id="quantity-type">{{ quantityTypeLabel }}</span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="quantity">Precio</label>
        <div class="input-group mb-3">
          <div>{{ buyed_price }}</div>
          <!-- <input class="form-control" type="number" min="0.01" :step="0.01" v-model="buyed_price" aria-describedby="currency"> -->
          <div class="input-group-append">
            <span class="input-group-text" id="currency">€</span>
          </div>
        </div>
      </div>
      <div class="alert alert-info d-flex justify-content-between">
        <div>Total:</div>
        <strong>{{ total }}€</strong>
      </div>
      <div class="text-right">
        <button type="button" class="btn btn-lg btn-success" @click="save()" :disabled="!validValues">{{ this.product.created ? 'Guardar' : 'Agregar' }}</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['product'],
  data(){
    return {
      quantity: this.product.quantity,
      buyed_price: this.product.buyed_price
    }
  },
  computed:{
    validValues(){
      return this.quantity > 0 && this.buyed_price > 0;
    },
    quantityStep(){
      return this.product.data.selling_type == 1 ? 1 : 50;
    },
    quantityTypeLabel(){
      return this.product.data.selling_type == 1 ? 'Unidades' : 'Grs.';
    },
    total(){
      return (this.quantity * (this.buyed_price / this.product.priceDivisionNumber)).toFixed(2);
    }
  },
  methods: {
    save(){
      this.product.created = true;
      this.product.quantity = this.quantity;
      this.product.buyed_price = this.buyed_price;
      this.$emit('save');
    }
  }

}
</script>

<style lang="css">
</style>
