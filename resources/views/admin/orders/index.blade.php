@extends('layouts.app')

@section('content')

  @include('admin.partials._breadcrumb', [
    'breadcrumbs' => [
      ['active' => true, 'label' => 'Pedidos']
    ]
  ])

  @include('admin.layouts._index', [
    'title' => 'Pedidos',
    'crear' => 'Pedido',
    'route' => 'pedidos',
    'values' => $orders,
    'attributes' => [
      ['label' => 'Id', 'slug' => 'id'],
      ['label' => 'Nombre', 'slug' => 'name'],
      ['label' => 'Email', 'slug' => 'email'],
      ['label' => 'Phone', 'slug' => 'phonel'],
      ['label' => 'Estado', 'slug' => 'status_label'],
      ['label' => '', 'slug' => 'edit_button']
    ]
  ])
@endsection
