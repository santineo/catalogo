<template>
<!-- Modal -->
<div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="modalConfirmLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalConfirmLabel" v-if="Modal.title" v-html="Modal.title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body position-relative">
        <loader :loading="Modal.loading" />
        <div v-if="Modal.error" v-html="Modal.error" class="alert alert-danger"></div>
        <div v-if="Modal.text" v-html="Modal.text"></div>
        <div class="form-group" v-if="Modal.input">
          <label v-if="Modal.input.label">{{ Modal.input.label }}</label>
          <input type="text" v-model="Modal.input.value" class="form-control">
        </div>
      </div>
      <div class="modal-footer" v-if="Modal.buttons">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" @click="trigger">Confirmar</button>
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
  data(){
    return {
      Modal,
    }
  },
  methods: {
    trigger(){
      Modal.callback(Modal.input ? Modal.input.value : null);
      Modal.close();
    }
  }
}
</script>
