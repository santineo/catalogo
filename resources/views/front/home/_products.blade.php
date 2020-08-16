<section id="products" class="home-products">
  <div class="container">
    <div class="d-flex align-items-center">
      <h2 class="mb-0 home-products-title">@lang('messages.home_ourProducts')</h2>
      <a href="{{ route('front.products.index') }}" class="btn btn-rounded btn-black ml-auto">@lang('messages.shared_seeAll')</a>
    </div>

    <div class="home-products-list">
      @include('front.partials.productList', compact('products'))
    </div>
  </div>
</section>
