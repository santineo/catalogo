<div class="product-list">

  <div class="row">
    @foreach ($products as $key => $product)
      <div class="col-lg-3 col-md-4 col-sm-6">

        <a href="{{ route('front.products.show', $product->slug) }}" class="product-list-card">

          <div class="product-list-card-image" style="background-image: url({{ $product->getPrimaryImage('thumb') }});">
            <img class="sr-only" src="{{ asset('images/example-product-1.png') }}" alt="" />
          </div>

          <h3 class="product-list-card-title">{{ $product->title }}</h3>

          @if (isset($offer))
            <div class="product-list-card-sale">
              <div class="sale">{{ $product->formatted_price }}</div>
              <div class="original">{{ $product->formatted_price }}</div>
            </div>
          @else
            <div class="product-list-card-price">{{ $product->formatted_price }}</div>
          @endif

        </a>

      </div>
    @endforeach
  </div>

</div>
