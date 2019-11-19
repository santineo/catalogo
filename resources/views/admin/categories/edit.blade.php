@extends('layouts.app')

@section('content')

  @include('admin.partials._breadcrumb', [
    'breadcrumbs' => [
      ['url' => route('categorias.index'), 'label' => 'Categorías'],
      ['active' => true, 'label' => 'Categoría ' . $category->name]
    ]
  ])

  @include('admin.layouts._edit', [
    'title' => $category->name,
    'route' => 'categorias',
    'model' => $category,
    'form' => 'admin.categories._form'
  ])
@endsection
