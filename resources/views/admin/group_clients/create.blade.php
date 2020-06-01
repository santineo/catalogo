@extends('layouts.app')

@section('content')

  @include('admin.partials._breadcrumb', [
    'breadcrumbs' => [
      ['url' => route('grupos.index'), 'label' => 'Grupos'],
      ['active' => true, 'label' => 'Nueva Grupo']
    ]
  ])

  @include('admin.layouts._create', [
    'title' => 'Grupos',
    'route' => 'grupos',
    'form' => 'admin.group_clients._form'
  ])
@endsection
