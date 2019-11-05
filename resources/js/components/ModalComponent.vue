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
      <div class="modal-body">
        <div v-if="Modal.text" v-html="Modal.text"></div>
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
export default {
  data(){
    return {
      Modal:Modal,
    }
  },
  methods: {
    trigger(){
      Modal.callback();
    }
  }
}
</script>
