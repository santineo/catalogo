<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Button;

class Order extends Model
{
    use Button;

    protected $guarded = ['products'];

    protected $with = ['products'];

    /**
     * Get the route name
     *
     * @return string
     */
    public function getRouteName()
    {
      return 'pedidos';
    }

    /**
     * Relationship with product
     *
     * @return Collection of App\Product
     */
    public function products()
    {
      return $this->belongsToMany('App\Product')->withPivot('buyed_price', 'quantity');
    }

    /**
     * Accesor for label of status
     *
     * @return string
     */
    public function getStatusLabelAttribute()
    {
      $statuses = [
        1 => 'Pendiente',
        2 => 'Aceptado',
        3 => 'Entregado',
        4 => 'Cancelado',
      ];

      return isset($statuses[$this->status]) ? $statuses[$this->status] : 'Error de estado';
    }

    /**
     * Return Admin Order path
     *
     * @return string
     */
    public function path()
    {
      return "/administracion/pedidos/{$this->id}";
    }

    /**
     * Sync Products and Refresh Stock if necessary
     *
     * @void
     */
    public function syncProducts($newProductsValues, $exceptStock = false)
    {
      foreach ($this->products->whereNotIn('id', array_keys($newProductsValues)) as $productToDetach){
        if(!$exceptStock && $productToDetach->validate_stock) $productToDetach->update(['stock' => $productToDetach->available_stock]);
        $this->products()->detach($productToDetach->id);
      }
      foreach ($this->products->whereIn('id', array_keys($newProductsValues)) as $productAttached) {
        if(!$exceptStock && $productAttached->validate_stock) $productAttached->update(['stock' => $productAttached->available_stock - $newProductsValues[$productAttached->id]['quantity']]);
        $this->products()->updateExistingPivot($productAttached, ['quantity' => $newProductsValues[$productAttached->id]['quantity']]);
        unset($newProductsValues[$productAttached->id]);
      }
      foreach (\App\Product::whereIn('id', array_keys($newProductsValues))->get() as $product) {
        if(!$exceptStock && $product->validate_stock) $product->update(['stock' => $product->stock - $newProductsValues[$product->id]['quantity']]);
        $this->products()->attach($product->id, $newProductsValues[$product->id]);
      }
    }

    /**
     * Sync Products and Refresh Stock if necessary
     *
     * @void
     */
    public function syncCartProducts($cartProducts)
    {
      foreach ($cartProducts as $product) {
        $this->products()->attach($product['id'], ['quantity' => $product['quantity'], 'buyed_price' => $product['data']['price']]);
      }
    }
}
