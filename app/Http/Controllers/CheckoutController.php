<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Return create View
     *
     * @return view
     */
    public function create()
    {
      $token = request('token');
      if(!$token) {
        $token = Str::random(60);
        session(['cart_' . $token => session('cart', [])]);
      }elseif(!session('cart_' . $token, false)){
        return redirect('/cart');
      }
      return view('front.checkout', array_merge(compact('token'), ['hideCart' => true]));
    }

    /**
     * Validate and Store Order
     *
     * @return json
     */
    public function store()
    {
      $cart = session('cart_' . request('token', ''), false);
      if(!request('token', false) || !$cart) abort(500);

      $order = new Order($this->validateRequest());
      $order->status = 1;
      $order->save();
      $order->syncCartProducts($cart);

      session(['cart_' . request('token', '') => false]);
      session(['cart' => false]);

      return response()->json(['status' => 'ok', 'order' => $order], 200);
    }

    /**
     * return request if validated
     *
     * @return array
     */
    private function validateRequest()
    {
      return request()->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'country' => 'required',
        'locality' => 'required',
        'city' => 'required',
        'zip_code' => 'required',
        'address_street' => 'required',
        'address_number' => 'required',
        'address_dpto' => 'sometimes',
        'additional_info' => 'sometimes',
      ]);
    }
}
