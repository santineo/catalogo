@extends('layouts.front')

@section('content')
  <div class="bg-white" id="productsShow">


      @include('front.partials.nav')


    <div class="container">

      @include('front.partials.breadcrumb')

      @include('front.products._productArticle')

      <section class="products-show-related">
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <h2 class="products-show-related-title">@lang('messages.shared_relatedProducts')</h2>
            </div>
            <div class="col-lg-4 text-lg-right">
              <a href="{{ route('front.products.index') }}" class="btn btn-rounded btn-black">
                @lang('messages.shared_seeAll')
              </a>
            </div>
          </div>

        <div class="products-show-related-list">
          @include('front.partials.productList', ['products' => \App\Product::withStock()->inRandomOrder()->take(4)->get()])
        </div>
      </section>
    </div>

  </div>
@endsection
