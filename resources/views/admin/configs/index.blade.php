@extends('layouts.app')

@section('content')

  @include('admin.partials._breadcrumb', [
    'breadcrumbs' => [
      ['active' => true, 'label' => 'Configuración']
    ]
  ])

  @include('admin.partials._alert')

  <div class="card mx-4 rounded-0">
    <div class="card-body">

    <div class="title mr-auto">Configuración</div>
    <div class="mt-4">
      <config-form :stored_configs="{{ json_encode($configs) }}"></config-form>
    </div>

    </div>
  </div>

@endsection
