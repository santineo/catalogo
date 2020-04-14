<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Upload;
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
        $products = Product::search(request('term'))->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
      $product = Product::create($this->validateRequest());

      $product->uploads()->saveMany($this->saveUploads());

      return redirect("{$product->path()}/editar")->with(['info' => 'Se ha guardado con éxito.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product)
    {
      $product->update($this->validateRequest());
      $product->uploads()->saveMany($this->saveUploads());
      $product->uploads()->cleanNotIn(request('uploads'));

      return back()->with(['info' => 'Se ha guardado con éxito.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('/administracion/productos')->with(['info' => "Se ha eliminado el producto {$product->title}"]);
    }

    /**
     * Retrieve Product List
     *
     * @json
     */
    public function getProducts()
    {
      $products = Product::search(request('term'))->take(30)->get();
      return response()->json(compact('products'), 200);
    }

    /**
     * Find Uploads and set order
     *
     * @return array
     */
    public function saveUploads()
    {
      $updateds = [];
      $uploads = Upload::whereIn('id', request('uploads',[]))->get();

      foreach (request('uploads', []) as $order => $uploadIdRequested) {
        $upload = $uploads->firstWhere('id', $uploadIdRequested);
        if(!$upload) continue;
        $upload->update(['order' => $order]);
        $updateds[] = $upload;
      }
      return $updateds;
    }

    /**
     * Validate the requested attributes
     *
     * @return array
     */
    public function validateRequest()
    {
      return request()->validate([
        'title' => 'required|max:150',
        'description' => 'required',
        'published' => 'sometimes',
        'price' => 'required|numeric|min:0|not_in:0',
        'selling_type' => 'required|numeric|in:1,2',
        'stock' => 'required_if:validate_stock,1|numeric|min:0',
        'validate_stock' => 'required|in:0,1',
        'category_id' => 'required|exists:categories,id',
        'brand_id' => 'nullable|exists:brands,id',
        'uploads.*' => 'required|exists:uploads,id',
      ]);
    }
}
