export default class Product {

    constructor(product){
      this.data = product;
      this.created = product.pivot;
      this.quantity = product.pivot ? product.pivot.quantity : 0;
      this.buyed_price = product.pivot ? product.pivot.buyed_price : product.price;
      this.priceDivisionNumber = product.selling_type == 1 ? 1 : 1000;
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
        quantity: this.quantity,
        buyed_price: this.buyed_price
     };
    }
}
