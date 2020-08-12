@extends('layouts.front')

@section('content')
  <div class="bg-white" id="productsShow">

    <div class="container">
      @include('front.partials.nav')
    </div>

    <div class="container">

      <div style="padding-top: 30px;">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb align-items-center" style="background: none;">
            <li class="breadcrumb-item" style="font-size: 16px;"><a href="{{ route('home') }}" style="color: #b2b2b2;"><i class="icon-home"></i></a></li>
            <li class="breadcrumb-item" style="font-size: 14px;"><a href="{{ route('front.products.index', ['category' => $product->category_id]) }}" style="color: #b2b2b2;">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active text-dark" style="font-size: 14px;" aria-current="page">{{ $product->title }}</li>
          </ol>
        </nav>
      </div>

      <article style="padding: 60px 0 108px 0;">
        <div class="row">
          <div class="col-6">
            <div class="d-flex">
              <div class="text-center" style="max-width: 476px">
                <img src="{{ $product->getPrimaryImage('large') }}" alt="" style="max-width: 476px; max-height: 476px;">
              </div>
              <div style="margin-left: 12px">
                <div class="text-center" style="max-width: 109px; margin-bottom:10px; opacity: 0.7;">
                  <img src="{{ $product->getPrimaryImage('large') }}" alt="" class="d-block" style="max-width: 109px; max-height: 109px;">
                </div>
                <div class="text-center" style="max-width: 109px; margin-bottom:10px; opacity: 0.7;">
                  <img src="{{ $product->getPrimaryImage('large') }}" alt="" class="d-block" style="max-width: 109px; max-height: 109px;">
                </div>
                <div class="text-center" style="max-width: 109px; margin-bottom:10px; opacity: 0.7;">
                  <img src="{{ $product->getPrimaryImage('large') }}" alt="" class="d-block" style="max-width: 109px; max-height: 109px;">
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div style="margin-bottom: 15px;">
              <h2 class="mb-0" style="font-weight: 300; font-size: 30px; line-height: 1.53;">{{ $product->title }}</h2>
              @if ($product->brand_id)
                <div class="text-gray">De <a class="text-secondary" style="text-decoration: underline;"href="{{ route('front.products.index', ['brand' => $product->brand_id]) }}">{{ $product->brand->name }}</a></div>
              @endif
            </div>

            <div style="font-size: 30px; line-height: 1.53;">
              @if (true)
                <div class="text-dark">${{ number_format($product->price, 2, ',', ' ') }}</div>
              @else
                <div class="d-flex align-items-center">
                  <div class="text-primary">$89.99</div>
                  <div class="text-gray" style="margin-left: 40px; text-decoration: line-through;">$119.99</div>
                </div>
              @endif
            </div>

            <div class="border-top" style="width: 321px; margin-top: 26px; margin-bottom: 23px;"></div>

            <div class="text-dark" style="font-size: 12px;line-height: 1.5; max-width: 50%; margin-bottom: 28px">
              <div class="mb-1">Descripción</div>
              <p class="mb-0" style="color: #a3a3a3">{!! $product->description !!}</p>
            </div>

            <div class="text-dark" style="font-size: 12px;line-height: 1.5; margin-bottom: 45px;">
              <div style="margin-bottom: 15px;">Cantidad</div>
              <div class="d-inline-block border">
                <div class="d-flex align-items-center" style="font-weight: 600; padding: 6px 11px">
                  <div style="width: 23px; height: 23px;" class="bg-dark text-white d-flex align-items-center justify-content-center">-</div>
                  <div style="padding: 0 17px;">1</div>
                  <div style="width: 23px; height: 23px;" class="bg-dark text-white d-flex align-items-center justify-content-center">+</div>
                </div>
              </div>
            </div>

            <a href="#" class="btn btn-secondary btn-lg text-white text-uppercase" style="font-size: 13px; font-weight: 600; padding: 15px 53px; border-radius: 50px;">Agregar Carrito</a>

          </div>
        </div>
      </article>
      <section class="border-top" style="padding: 55px 0 135px 0;">
        <div class="container">
          <div class="d-flex align-items-center" style="margin-bottom: 70px;">
            <h2 class="mb-0" style="font-size: 29px; font-weight: 300;">Productos relacionados</h2>
            <a href="{{ route('front.products.index') }}" class="btn btn-rounded border ml-auto">Ver Todos</a>
          </div>

        @include('front.partials._productList', ['products' => \App\Product::withStock()->inRandomOrder()->take(4)->get()])
      </section>
    </div>

  </div>
@endsection
