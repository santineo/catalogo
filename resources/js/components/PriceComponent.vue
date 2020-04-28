<template>
  <div class="d-flex">

    <div class="pr-1">
      <label for="sellingType">Tipo de Presentación*</label>
      <select class="custom-select" v-model="sellingType" id="sellingType" name="selling_type">
        <option value="1">Unidad</option>
        <option value="2">Peso</option>
      </select>
    </div>

    <div class="pl-1">
      <label for="price">Precio*</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">$</span>
        </div>
        <input type="number" step="0.01" name="price" class="form-control" v-model="price" required>
        <div class="input-group-append">
          <span class="input-group-text">{{ unitLabel }}</span>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
export default {
  props: ['model_price', 'model_selling_type'],
  data(){
    return {
      price: 0,
      sellingType: 1
    }
  },
  mounted(){
    if(this.model_price) this.price = this.model_price;
    if(this.model_selling_type) this.sellingType = this.model_selling_type;
  },
  computed:{
    unitLabel(){
      if(this.sellingType == 2) return 'x KG.';
      return 'x Unidad';
    }
  }
}
</script>
