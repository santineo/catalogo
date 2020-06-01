@extends('layouts.app')

@section('content')

  @include('admin.partials._breadcrumb', [
    'breadcrumbs' => [
      ['url' => route('clientes.index'), 'label' => 'Clientes'],
      ['active' => true, 'label' => 'Nuevo Cliente']
    ]
  ])

  @include('admin.layouts._create', [
    'title' => 'Clientes',
    'route' => 'clientes',
    'form' => 'admin.clients._form'
  ])
@endsection
