<template>
  <div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="max-width: 700px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Previsualización de Email de Productos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <loader :loading="!preview" />
          <div v-if="preview" v-html="preview"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Loader from './LoaderComponent.vue';
export default {
  components: {
    'loader': Loader
  },
  props:['preview']
}
</script>

<style lang="css">
</style>
