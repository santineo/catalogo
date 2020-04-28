@extends('layouts.front')

@section('content')
  <header class="py-4">
    <div class="container">
      <div class="row">
        @include('front.partials._categoryCard', ['url' => route('front.products.index', ['category' => 1]), 'category' => 'Categoría', 'image' => '', 'cssClass' => 'col-md-3 col-sm-6'])
        @include('front.partials._categoryCard', ['url' => route('front.products.index', ['category' => 2]), 'category' => 'Categoría', 'image' => '', 'cssClass' => 'col-md-3 col-sm-6'])
        @include('front.partials._categoryCard', ['url' => route('front.products.index', ['category' => 3]), 'category' => 'Categoría', 'image' => '', 'cssClass' => 'col-md-3 col-sm-6'])
        @include('front.partials._categoryCard', ['url' => route('front.products.index', ['category' => 4]), 'category' => 'Categoría', 'image' => '', 'cssClass' => 'col-md-3 col-sm-6'])
      </div>
    </div>
  </header>

  <section>
    <div class="container">
      <h2 class="mb-4">Nuestros productos</h2>
      <div class="row">
        @foreach($products as $product)
          @include('front.partials._productCard', compact($product))
        @endforeach
      </div>
      <div class="text-center">
        <a href="{{ route('front.products.index') }}" class="btn btn btn-link">Ver todos los productos</a>
      </div>
    </div>
  </section>
  {{-- <div class="">
  <product-checkout :product="{{ \App\Product::first()->toJson() }}"></product-checkout>
  <cart></cart>
</div> --}}
@endsection
