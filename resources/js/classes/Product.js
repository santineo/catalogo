export default class Product {

    constructor(product, quantity){
      this.data = product;
      this.priceDivisionNumber = product.selling_type == 1 ? 1 : 1000;
      this.created = product.pivot;

      this.cleanBasics(quantity);
      if(this.created) this.setCreatedProduct();
    }

    setData(product){
      this.data = product;
    }

    getTotal(){
      return (this.quantity * (this.buyed_price / this.priceDivisionNumber)).toFixed(2);
    }

    getFormFormat(){
      return  {
        id: this.data.id,
        quantity: this.quantity
     };
    }

    getUnityType(){
      return this.data.selling_type == 1 ? 'Unidades' : 'Gramos';
    }

    setCreatedProduct(){
      this.quantity = this.data.pivot.quantity;
      this.buyed_price = this.data.pivot.buyed_price;
    }

    cleanBasics(quantity){
      this.quantity = quantity ? quantity : (this.data.selling_type == 1 ? 1 : 25);
      this.buyed_price = this.data.price;
    }
}
