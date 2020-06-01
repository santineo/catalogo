@extends('layouts.app')

@section('content')

  @include('admin.partials._breadcrumb', [
    'breadcrumbs' => [
      ['url' => route('clientes.index'), 'label' => 'Clientes'],
      ['active' => true, 'label' => 'Cliente ' . $client->name]
    ]
  ])

  @include('admin.layouts._edit', [
    'title' => $client->name,
    'route' => 'clientes',
    'model' => $client,
    'form' => 'admin.clients._form'
  ])
@endsection
