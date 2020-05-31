<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categories = Category::search(request('term'))->get();

      if(request()->ajax()) return response()->json(compact('categories'));
      
      return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
      $category = Category::create($this->validateRequest());

      if(request()->ajax()) return response()->json(compact('category'), 200);

      return redirect('/administracion/categorias')->with(['info' => "Se ha creado la categoría {$category->name}"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
      return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category)
    {
        $category->update($this->validateRequest());

        return redirect('/administracion/categorias')->with(['info' => "Se ha guardado la categoría {$category->name}"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->products->count()) return redirect('/administracion/categorias')->withErrors(['product_assigned' => 'No se puede eliminar la categoría si tiene productos asignados.']);
        $category->delete();

        return redirect('/administracion/categorias')->with(['info' => "Se ha eliminado la categoría {$category->name}"]);
    }

    /**
     * Validate the requested attributes
     *
     * @return array
     */
    public function validateRequest()
    {
      return request()->validate([
        'name' => 'required|max:200',
      ]);
    }
}
