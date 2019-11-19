@extends('layouts.app')

@section('content')

  @include('admin.partials._breadcrumb', [
    'breadcrumbs' => [
      ['url' => route('categorias.index'), 'label' => 'Categorías'],
      ['active' => true, 'label' => 'Nueva Categoría']
    ]
  ])

  @include('admin.layouts._create', [
    'title' => 'Categorías',
    'route' => 'categorias',
    'form' => 'admin.categories._form'
  ])
@endsection
