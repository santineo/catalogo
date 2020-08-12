@extends('layouts.front')

@section('content')
  <div id="home">

    <div class="home-intro">

      <div class="home-nav-container">
        <div class="container">
          @include('front.partials.nav')
        </div>
      </div>

      @include('front.partials._slider')

    </div>
    @include('front.partials._tax2')

    <section style="padding-top: 50px;">
      <div class="container">
        <div class="d-flex align-items-center" style="margin-bottom: 70px;">
          <h2 class="mb-0" style="font-size: 29px; font-weight: 300;">Nuestros productos</h2>
          <a href="{{ route('front.products.index') }}" class="btn btn-rounded border ml-auto">Ver Todos</a>
        </div>
        @include('front.partials._productList', compact('products'))
      </section>

    </div>
  @endsection
