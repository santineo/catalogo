export default class Cart{
  constructor(){
    this.loading = true;
    this.products = [];
    this.token = false;
    this.created = false;
    this.updated = false;
    this.modals = {
      destroy: {
        id: 'destroyProductModalId',
        product: false
      },
      modify: {
        id:'modifyProductModalId',
        product: false
      }
    };
  }

  fetchCart(token){
    this.token = token;
    this.connect('getCart', {token});
  }

  add(params, callback){
    params.storing = true;
    this.connect('add', params, callback);
  }

  update(params, callback){
    params.storing = true;
    this.connect('update', params, callback);
  }

  remove(params, callback){
    this.connect('remove', params, callback);
  }

  confirmation(id, type){
    this.modals[type].product = this.products.find(product => product.id == id);
    if(this.modals[type].product) $(`#${this.modals[type].id}`).modal('show');
  }

  connect(url, params = {}, callback = false){
    this.loading = true;
    axios.post(`/cart/${url}`, params)
    .then((response) => {
      this.setCart(response.data.cart);
      if(response.data.alert) Alert.open(response.data.alert.type, response.data.alert.message, response.data.alert.title);
      if(url == 'remove' || url == 'update' || url == 'add') this.updated = true;
    })
    .catch((error) => {
      console.log(error);
    })
    .then(() => {
      this.loading = false;
      this.created = true;
      if(callback) callback();
    });
  }

  setCart(cart){
    this.products = cart;
  }

  getProductNoImage(size = 'url'){
    return '/images/no-product-image' + (size != 'url' ? `_${size}` : '') + '.png';
  }

  getTotal(){
    let price = 0;
    this.products.forEach((product) => {
      price += product.quantity * (product.data.selling_type == 1 ? product.data.price : product.data.price / 1000);
    });

    return (price).toFixed(2);
  }
}
