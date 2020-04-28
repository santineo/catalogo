<div class="mb-4 col-lg-3 col-md-4 col-sm-6">
  <a href="{{ route('front.products.show', $product->slug) }}" class="card card-product">
    <div class="card-product-image border-bottom">
      <img src="{{ $product->getPrimaryImage('thumb') }}" alt="" class="w-100 img-fluid" />
    </div>
    <div class="p-2">
      <div class="card-product-title">
        {{ $product->title }}
      </div>
      <div class="card-product-price text-right mt-1">
        €{{ $product->price }} <small>/ {{ $product->selling_type == 1 ? 'unidad' : 'kilo' }}</small>
      </div>
    </div>
  </a>
</div>
