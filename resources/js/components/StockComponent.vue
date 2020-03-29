<template>
  <div class="d-flex align-items-center" style="min-height:69px">

    <div>
      <div class="custom-control custom-checkbox mt-4 mr-4">
        <input type="hidden" name="validate_stock" value="0">
        <input type="checkbox" class="custom-control-input" value="1" v-model="validateStock" id="validateStock" name="validate_stock">
        <label class="custom-control-label" for="validateStock">Asignar Stock</label>
      </div>
    </div>

    <div v-show="validateStock">
      <label for="stock">Stock</label>
      <input type="number" min="0" class="form-control" name="stock" id="stock" v-model="stock">
    </div>

  </div>
</template>

<script>
export default {
  props: ['model_stock', 'model_validate_stock'],
  data(){
    return {
      stock: 0,
      validateStock: 0,
    }
  },
  mounted(){
    if(this.model_validate_stock) this.validateStock = this.model_validate_stock;
    if(this.model_stock) this.stock = this.model_stock;
  }
}
</script>
