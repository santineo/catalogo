@extends('layouts.app')

@section('content')

  @include('admin.partials._breadcrumb', [
    'breadcrumbs' => [
      ['url' => route('grupos.index'), 'label' => 'Grupos'],
      ['active' => true, 'label' => 'Grupo ' . $groupClient->name]
    ]
  ])

  @include('admin.layouts._edit', [
    'title' => $groupClient->name,
    'route' => 'grupos',
    'model' => $groupClient,
    'form' => 'admin.group_clients._form'
  ])
@endsection
