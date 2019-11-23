@extends('layouts.app')

@section('content')

  @include('admin.partials._breadcrumb', [
    'breadcrumbs' => [
      ['url' => route('productos.index'), 'label' => 'Productos'],
      ['active' => true, 'label' => 'Producto ' . $product->title]
    ]
  ])

  @include('admin.layouts._edit', [
    'title' => $product->title,
    'route' => 'productos',
    'model' => $product,
    'form' => 'admin.products._form'
  ])
@endsection
