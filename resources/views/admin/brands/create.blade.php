@extends('layouts.app')

@section('content')

  @include('admin.partials._breadcrumb', [
    'breadcrumbs' => [
      ['url' => route('marcas.index'), 'label' => 'Marcas'],
      ['active' => true, 'label' => 'Nueva Marca']
    ]
  ])

  @include('admin.layouts._create', [
    'title' => 'Marcas',
    'route' => 'marcas',
    'form' => 'admin.brands._form'
  ])
@endsection
