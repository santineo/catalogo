class Modal {

  constructor(callback){
      this.callback = false;
      this.title = false;
      this.text = false;
      this.buttons = false;

      this.evented = false;
  }

  close(){
    $('#modalConfirm').modal('hide');
  }

  open(){
    $('#modalConfirm').modal('show');

    if(!this.evented){
      $('#modalConfirm').on('hidden.bs.modal', () => {
        this.title = false;
        this.text = false;
        this.buttons = false;
      });
      this.evented = true;
    }
  }

  delete(callback){
    this.callback = callback;
    this.title = 'Esta acción necesita confirmación';
    this.text = '¿Esta seguro de eliminar el elemento?';
    this.buttons = true;
    this.open();
  }

}

export default Modal;
