@extends('layouts.app')

@section('content')

  @include('admin.partials._breadcrumb', [
    'breadcrumbs' => [
      ['active' => true, 'label' => 'Contactos']
    ]
  ])

  @include('admin.layouts._index', [
    'title' => 'Contactos',
    'route' => 'contactos',
    'values' => $contacts,
    'attributes' => [
      ['label' => '#', 'slug' => 'id'],
      ['label' => 'Nombre', 'slug' => 'name'],
      ['label' => 'Email', 'slug' => 'email'],
      ['label' => 'Tel.', 'slug' => 'phone'],
      ['label' => '', 'slug' => 'show_button']
    ]
  ])
@endsection
