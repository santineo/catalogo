<template>
  <div class="rounded bg-light border p-2 d-flex justify-content-between align-items-center mb-2">
    <div class="d-flex">
        <div class="ml-2 text-primary">#{{ product.data.id }}</div>
        <strong class="ml-2">{{ product.data.title }}</strong>
    </div>
    <div class="d-flex align-items-center">
      <div>Precio por Unidad: <strong>{{ product.buyed_price }}€</strong></div>
      <div class="ml-4">Cantidad: <strong>{{ product.quantity }}</strong></div>
      <div class="ml-4">Total: <strong>{{ product.getTotal() }}€</strong></div>
      <button class="btn btn-sm btn-success ml-5" @click="$emit('edit')" type="button"><i class="fas fa-edit"></i></button>
      <button class="btn btn-sm btn-danger ml-2" @click="confirmDelete()" type="button"><i class="fas fa-times"></i></button>
    </div>
  </div>
</template>

<script>
export default {
  props: ['product'],
  methods:{
    confirmDelete(){
      Modal.delete(this.emitDelete);
    },
    emitDelete(){
      this.$emit('delete');
    }
  }
}
</script>
