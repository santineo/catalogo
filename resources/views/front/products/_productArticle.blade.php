<alert></alert>

<article class="product-article">
  <div class="row">

    <div class="col-lg-6">
      <div class="d-flex">
        <div class="product-article-image">
          <img src="{{ $product->getPrimaryImage('large') }}" alt="">
        </div>
        {{-- <div style="margin-left: 12px">
        <div class="text-center" style="max-width: 109px; margin-bottom:10px; opacity: 0.7;">
        <img src="{{ $product->getPrimaryImage('large') }}" alt="" class="d-block" style="max-width: 109px; max-height: 109px;">
      </div>
      <div class="text-center" style="max-width: 109px; margin-bottom:10px; opacity: 0.7;">
      <img src="{{ $product->getPrimaryImage('large') }}" alt="" class="d-block" style="max-width: 109px; max-height: 109px;">
    </div>
    <div class="text-center" style="max-width: 109px; margin-bottom:10px; opacity: 0.7;">
    <img src="{{ $product->getPrimaryImage('large') }}" alt="" class="d-block" style="max-width: 109px; max-height: 109px;">
  </div>
</div> --}}
</div>
</div>

<div class="col-lg-6">
  <div class="product-article-header">
    <h2 class="product-article-header-title">{{ $product->title }}</h2>
    @if ($product->brand_id)
      <div class="product-article-header-brand">
        <span>@lang('messages.shared_of') </span>
        <a href="{{ route('front.products.index', ['brand' => $product->brand_id]) }}">{{ $product->brand->name }}</a>
      </div>
    @endif
  </div>

  <div class="product-article-price">
    @if (true)
      <div class="current">{{ $product->formatted_price }}</div>
    @else
      <div class="offer">$89.99</div>
      <div class="original">{{ $product->formatted_price }}</div>
    @endif
  </div>

    <div class="product-article-description">
      <h3>@lang('messages.shared_description')</h3>
      <p>{!! $product->description !!}</p>
    </div>

    <product-checkout :product="{{ $product->toJson() }}" label_quantity="@lang('messages.shared_quantity')" label_button="@lang('messages.productArticle_addToCart')" />
  </div>

</div>
</article>
