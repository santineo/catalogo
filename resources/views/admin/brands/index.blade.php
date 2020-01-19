@extends('layouts.app')

@section('content')

  @include('admin.partials._breadcrumb', [
    'breadcrumbs' => [
      ['active' => true, 'label' => 'Marcas']
    ]
  ])

  @include('admin.layouts._index', [
    'title' => 'Marcas',
    'crear' => 'Marca',
    'route' => 'marcas',
    'values' => $brands,
    'attributes' => [
      ['label' => 'Nombre', 'slug' => 'name'],
      ['label' => 'Productos', 'slug' => 'products_count'],
      ['label' => '', 'slug' => 'edit_button'],
      ['label' => '', 'slug' => 'delete_button']
    ]
  ])
@endsection
