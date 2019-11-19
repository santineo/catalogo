@extends('layouts.app')

@section('content')

  @include('admin.partials._breadcrumb', [
    'breadcrumbs' => [
      ['active' => true, 'label' => 'Productos']
    ]
  ])

  @include('admin.layouts._index', [
    'title' => 'Productos',
    'crear' => 'Producto',
    'route' => 'productos',
    'values' => App\Product::all(),
    'attributes' => [
      ['label' => 'Título', 'slug' => 'title'],
      ['label' => '', 'slug' => 'edit_button'],
      ['label' => '', 'slug' => 'delete_button']
    ]
  ])
@endsection
