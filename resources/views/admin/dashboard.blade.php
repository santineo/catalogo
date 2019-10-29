@extends('layouts.app')

@section('content')

  <div class="card w-50 m-auto">
    <div class="card-header">
      Dashboard
    </div>
    <div class="card-body">
      <h5 class="card-title">Bienvenido a su catalogo de productos</h5>
      <p class="card-text">En este catalogo podrá cargar y administrar sus productos.</p>
      <a href="{{ route('productos.index') }}" class="btn btn-primary">Administrar Productos</a>
    </div>
  </div>
@endsection
