@extends('layouts.app')

@section('content')

  @include('admin.partials._breadcrumb', [
    'breadcrumbs' => [
      ['url' => route('productos.index'), 'label' => 'Productos'],
      ['active' => true, 'label' => 'Nueva Producto']
    ]
  ])

  @include('admin.layouts._create', [
    'title' => 'Producto',
    'route' => 'productos',
    'form' => 'admin.products._form'
  ])
@endsection
