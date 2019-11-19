@extends('layouts.app')

@section('content')

  @include('admin.partials._breadcrumb', [
    'breadcrumbs' => [
      ['active' => true, 'label' => 'Categorías']
    ]
  ])

  @include('admin.layouts._index', [
    'title' => 'Categorías',
    'crear' => 'Categoría',
    'route' => 'categorias',
    'values' => App\Category::all(),
    'attributes' => [
      ['label' => 'Nombre', 'slug' => 'name'],
      ['label' => 'Productos', 'slug' => 'products_count'],
      ['label' => '', 'slug' => 'edit_button'],
      ['label' => '', 'slug' => 'delete_button']
    ]
  ])
@endsection
