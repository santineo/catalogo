<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.brands.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $brand = Brand::create($this->validateRequest());

        return redirect('/administracion/marcas')->with(['info' => "Se ha creado la marca {$brand->name}"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return view('admin.brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Brand $brand)
    {
        $brand->update($this->validateRequest());

        return redirect('/administracion/marcas')->with(['info' => "Se ha guardado la marca {$brand->name}"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
      if($brand->products->count()) return redirect('/administracion/marcas')->withErrors(['product_assigned' => 'No se puede eliminar la marca si tiene productos asignados.']);
      $brand->delete();

      return redirect('/administracion/marcas')->with(['info' => "Se ha eliminado la marca {$brand->name}"]);
    }

    /**
     * Validate requested files
     *
     * @return array
     */
    public function validateRequest()
    {
      return request()->validate([
          'name' => 'required'
      ]);
    }
}
