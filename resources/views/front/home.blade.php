@extends('layouts.front')

@section('content')
  <div id="home">
    <div class="home-intro">

      <div class="home-nav-container">
        <div class="container">
          @include('front.partials.nav')
        </div>
      </div>

      @include('front.partials._slider', [
        'slideImage' => $home->slider_image->image,
        'slideTitle' => $home->slider_title->value,
        'slideLink' => $home->slider_button_link->value,
        'slideButtonText' => $home->slider_button_text->value,
      ])

    </div>
    @include('front.partials._tax2', [ 'tax' => [
      ['category' => $home->category_1->getCategory(), 'image' => $home->category_image_1->image],
      ['category' => $home->category_2->getCategory(), 'image' => $home->category_image_2->image]
      ]])

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
