@extends('layouts.app')

@section('content')

  @include('admin.partials._breadcrumb', [
    'breadcrumbs' => [
      ['url' => route('marcas.index'), 'label' => 'Marcas'],
      ['active' => true, 'label' => 'Marca ' . $brand->name]
    ]
  ])

  @include('admin.layouts._edit', [
    'title' => $brand->name,
    'route' => 'marcas',
    'model' => $brand,
    'form' => 'admin.brands._form'
  ])
@endsection
