<?php

function sessionCartTotal(){
  $products = session('cart', []);
  $price = 0;
  foreach ($products as $product) {
    $productPrice = $product['data']->price * ($product['data']->selling_type == 1 ? 1 : 0.001);
    $price += $productPrice * $product['quantity'];
  }

  return $price;
}
