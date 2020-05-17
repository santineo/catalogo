class Modal {

  constructor(callback){
      this.callback = callback;
      this.title = false;
      this.text = false;
      this.input = false;
      this.buttons = false;
      this.loading = false;
      this.error = false;

      this.evented = false;
  }

  close(){
    $('#modalConfirm').modal('hide');
  }

  open(){
    $('#modalConfirm').modal('show');

    this.setCleanWhenClose();
  }

  delete(callback){
    this.callback = callback;
    this.title = 'Esta acción necesita confirmación';
    this.text = '¿Esta seguro de eliminar el elemento?';
    this.buttons = true;
    this.open();
  }

  create(attributes){
    this.callback = attributes.callback;
    this.title = attributes.title;
    this.text = attributes.text;
    this.input = attributes.input;
    this.loading = attributes.loading;
    this.buttons = true;

    this.open();
  }

  show(attributes){
    this.title = attributes.title;
    this.text = attributes.text;
    this.loading = attributes.loading;
    this.buttons = false;

    this.open();
  }

  throw(message = 'Ha ocurrido un error al cargar el recurso. Refresca la página e intente de nuevo.'){
    this.error = message;
  }

  setCleanWhenClose(){
    if(!this.evented){
      $('#modalConfirm').on('hidden.bs.modal', () => {
        this.title = false;
        this.text = false;
        this.input = false;
        this.buttons = false;
        this.loading = false;
        this.error = false;
      });
      this.evented = true;
    }
  }

}

export default Modal;
