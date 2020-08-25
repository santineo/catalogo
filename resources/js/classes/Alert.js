export default class Alert {
  constructor(){
    this.show = false;
    this.canClose = false;
    this.clean();
  }

  clean(){
    this.title = false;
    this.message = false;
    this.type = false;
  }

  close(){
    this.show = false;
    this.clean();
  }

  open(type, message, title){
    this.type = type;
    this.message = message;
    this.title = title;
    this.show = true;
  }
}
