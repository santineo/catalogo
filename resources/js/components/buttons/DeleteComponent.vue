<template>
<form class="" :action="url" method="post">
  <input type="hidden" name="_token" :value="token">
  <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
</form>
</template>

<script>
export default {
  props: ['url'],
  data(){
    return {
      token: csrf,
    }
  }
}
</script>

<style lang="css">
</style>
