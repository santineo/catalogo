<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\CartRequest;

class CartController extends Controller
{
    /**
     * Cart View
     *
     * @return view
     */
    public function cart()
    {
        return view('front.cart', ['hideCart' => true]);
    }

    /**
     * Get Session Cart
     *
     * @return json
     */
    public function getCart()
    {
      $cartName = 'cart';
      if(request('token') && session('cart_' . request('token'), false)) $cartName = 'cart_' . request('token');

      return response()->json(['cart' => array_values(session($cartName, []))], 200);
    }

    /**
     * Add product to session cart
     *
     * @return json
     */
    public function add(CartRequest $request)
    {
      $cart = $this->getSessionCart();
      $hasThisProduct = $cart->has($request->product->id);
      if($hasThisProduct){
        $cart->replace([$request->product->id => $productUpdated]);
        return $this->storeAndResponse($cart, ['type' => 'warning', 'title' => 'Este articulo ya se encontraba en tu cesta.', 'message' => "<a href=\"{$productUpdated['data']->public_path}\">{$productUpdated['data']->title}</a> se ha actualizado a <strong>{$cart->find($productUpdated['data']->id)->quantity}</strong><small>{$productUpdated['data']->getQuantityLabelUnity($cart->find($productUpdated['data']->id)->quantity)}</small>"]);
      }else{
        $newProduct = array_merge($request->all(), ['data' => $request->product]);
        $cart = $cart->push($newProduct);
      }


      return $this->storeAndResponse($cart, ['type' => 'success', 'title' => 'Cesta Actualizada', 'message' => "Se ha agregado <a href=\"{$newProduct['data']->public_path}\">{$newProduct['data']->title}</a> x {$newProduct['quantity']}."]);
    }

    /**
     * Update session cart product
     *
     * @return json
     */
    public function update(CartRequest $request)
    {
      $cart = $this->getSessionCart();
      $productUpdated = array_merge($request->all(), ['data' => $request->product]);
      $hasThisProduct = $cart->has($request->product->id);
      if($hasThisProduct){
        $cart = $cart->replace([$request->product->id => $productUpdated]);
      }else{
        return $this->storeAndResponse($cart, ['type' => 'warning', 'title' => 'Mensaje importante sobre tu cesta', 'message' => 'El producto intentó modificar ha sido eliminado de la cesta recientemente.']);
      }

      return $this->storeAndResponse($cart, ['type' => 'success', 'title' => 'Cesta modificada', 'message' => "Se ha actualizado <a href=\"{$productUpdated['data']->public_path}\">{$productUpdated['data']->title}</a> a <strong>{$productUpdated['quantity']}</strong><small>{$productUpdated['data']->getQuantityLabelUnity($productUpdated['quantity'])}</small>"]);
    }

    /**
     * Remove product from session cart
     *
     * @return json
     */
    public function remove(CartRequest $request)
    {
      $cart = $this->getSessionCart();

      $hasThisProduct = $cart->has($request->product->id);
      if($hasThisProduct) $cart->forget($request->product->id);

      return $this->storeAndResponse($cart, ['type' => 'success', 'title' => 'Cesta modificada', 'message' => "Se ha removido <a href=\"{$request->product->public_path}\">{$request->product->title}</a> de su cesta."]);
    }

    /**
     * Retrieve collection instance of session cart
     *
     * @return collection
     */
    private function getSessionCart()
    {
      return collect(session('cart', []))->keyBy('id');
    }

    /**
     * Save cart in session
     *
     * @return response
     */
    private function storeAndResponse($cartCollection, $alert = [])
    {
      $cart = $cartCollection->toArray();
      session(compact('cart'));

      return response()->json(['cart' => array_values(session('cart', [])), 'alert' => $alert], 200);
    }
}
