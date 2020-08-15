<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::brand(request('brand', false))->search(request('term', false))->category(request('category', false))->paginate(24);
        $category = request('category') ? Category::find(request('category')) : false;

        return view('front.products.index', compact('products', 'category'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::slug($slug)->firstOrFail();

        return view('front.products.show', compact('product'));
    }

}
