@extends('layouts.app')

@section('content')

  @include('admin.partials._breadcrumb', [
    'breadcrumbs' => [
      ['url' => route('pedidos.index'), 'label' => 'Pedidos'],
      ['active' => true, 'label' => 'Pedido #' . $order->id]
    ]
  ])

  @include('admin.layouts._edit', [
    'title' => "Pedido #$order->id",
    'route' => 'pedidos',
    'model' => $order,
    'vueForm' => 'order-form'
  ])
@endsection
