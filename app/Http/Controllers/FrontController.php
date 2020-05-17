<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class FrontController extends Controller
{
    /**
     * Retrieve homepage view
     *
     * @return view
     */
    public function home()
    {
      $products = Product::withStock()->inRandomOrder()->take(12)->get();
      return view('front.home', compact('products'));
    }

}
