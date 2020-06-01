@extends('layouts.app')

@section('content')

  @include('admin.partials._breadcrumb', [
    'breadcrumbs' => [
      ['active' => true, 'label' => 'Clientes']
    ]
  ])

  @include('admin.layouts._index', [
    'title' => 'Clientes',
    'crear' => 'Cliente',
    'route' => 'clientes',
    'values' => $clients,
    'attributes' => [
      ['label' => 'Nombre', 'slug' => 'name'],
      ['label' => 'Email', 'slug' => 'email'],
      ['label' => 'Teléfono', 'slug' => 'phone'],
      ['label' => '', 'slug' => 'show_button'],
      ['label' => '', 'slug' => 'edit_button'],
      ['label' => '', 'slug' => 'delete_button']
    ]
  ])
@endsection
