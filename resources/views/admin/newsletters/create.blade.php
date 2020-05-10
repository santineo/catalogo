@extends('layouts.app')

@section('content')

  @include('admin.partials._breadcrumb', [
    'breadcrumbs' => [
      ['url' => 'javascript: void(0);', 'label' => 'Newsletters'],
      ['active' => true, 'label' => 'Nuevo Newsletter']
    ]
  ])

  @include('admin.layouts._create', [
    'title' => 'Newsletter',
    'route' => 'newsletters',
    'vueForm' => 'newsletter-form'
  ])
@endsection
