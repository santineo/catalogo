<template>
<form :action="url" method="post" ref="form">
  <input type="hidden" name="_token" :value="token">
  <input name="_method" type="hidden" value="DELETE">
  <button type="button" class="btn btn-sm btn-danger" @click.prevent="confirm()">Eliminar</button>
</form>
</template>

<script>
export default {
  props: ['url'],
  data(){
    return {
      token: csrf,
    }
  },
  methods: {
    confirm(){
      Modal.delete(this.submit);
    },
    submit(){
      this.$refs.form.submit();
    }
  }
}
</script>
