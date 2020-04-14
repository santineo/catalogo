@extends('layouts.app')

@section('content')

  @include('admin.partials._breadcrumb', [
    'breadcrumbs' => [
      ['url' => route('pedidos.index'), 'label' => 'Pedidos'],
      ['active' => true, 'label' => 'Nuevo Pedido']
    ]
  ])

  @include('admin.layouts._create', [
    'title' => 'Pedido',
    'route' => 'pedidos',
    'vueForm' => 'order-form'
  ])
@endsection
