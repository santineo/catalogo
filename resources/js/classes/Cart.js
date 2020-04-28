export default class Cart{
  constructor(){
    this.loading = false;
    this.products = [];
    this.fetchCart();
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

  fetchCart(){
    this.connect('getCart');
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
      this.products = response.data.cart;
      if(response.data.alert) Alert.open(response.data.alert.type, response.data.alert.message, response.data.alert.title);
    })
    .catch((error) => {
      console.log(error);
    })
    .then(() => {
      this.loading = false;
      if(callback) callback();
    });
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
