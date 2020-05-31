@extends('layouts.front')

@section('content')
  <header class="py-4">
    <div class="container">
      <div class="row">
        @include('front.partials._categoryCard', ['category' => $home->category_1->getCategory(), 'image' => $home->category_image_1->image, 'cssClass' => 'col-md-3 col-sm-6'])
        @include('front.partials._categoryCard', ['category' => $home->category_2->getCategory(), 'image' => $home->category_image_2->image, 'cssClass' => 'col-md-3 col-sm-6'])
        @include('front.partials._categoryCard', ['category' => $home->category_3->getCategory(), 'image' => $home->category_image_3->image, 'cssClass' => 'col-md-3 col-sm-6'])
        @include('front.partials._categoryCard', ['category' => $home->category_4->getCategory(), 'image' => $home->category_image_4->image, 'cssClass' => 'col-md-3 col-sm-6'])
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
