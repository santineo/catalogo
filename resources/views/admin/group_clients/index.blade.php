@extends('layouts.app')

@section('content')

  @include('admin.partials._breadcrumb', [
    'breadcrumbs' => [
      ['active' => true, 'label' => 'Grupos']
    ]
  ])

  @include('admin.layouts._index', [
    'title' => 'Grupos',
    'crear' => 'Grupo',
    'route' => 'grupos',
    'values' => $groupClients,
    'attributes' => [
      ['label' => 'Nombre', 'slug' => 'name'],
      ['label' => 'Clientes', 'slug' => 'clients_count'],
      ['label' => '', 'slug' => 'edit_button'],
      ['label' => '', 'slug' => 'delete_button']
    ]
  ])
@endsection
