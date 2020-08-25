@extends('layouts.front')

@section('content')

  <div id="cartIndex">

    @include('front.partials.nav')

    <div class="container">

      <section class="cart">

        <cart-products></cart-products>

        <div class="cart-footer" v-if="Cart.products.length">
          <a href="{{ route('front.products.index') }}" class="cart-footer-back">
            <i class="icon-left"></i>
            <span>@lang('messages.cart_continueBuying')</span>
          </a>
          <div class="cart-footer-promocional">
            {{-- CODIGO PROMOCIONAL --}}
          </div>
          <div class="cart-footer-checkout">
            <div class="cart-footer-checkout-total">
              <span>@lang('messages.cart_total')</span> <strong class="cart-footer-checkout-total-number">{{ env('APP_CURRENCY', '$') }}@{{ Cart.getTotal() }}</strong>
            </div>
            <a href="{{ route('front.checkout.create') }}" class="btn btn-secondary btn-rounded btn-rounded-lg">@lang('messages.cart_checkout')</a>
          </div>
        </div>

      </section>

      <section class="products-show-related">
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <h2 class="products-show-related-title">@lang('messages.home_ourProducts')</h2>
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
