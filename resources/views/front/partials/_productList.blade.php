
    <div class="row" style="margin: 0 -33px;">
      @foreach ($products as $key => $product)
        <div class="col-lg-3 col-md-4 col-sm-6" style="padding: 0 33px; margin-bottom: 60px;">
          <a href="{{ route('front.products.show', $product->slug) }}" class="product-card text-decoration-none d-block" style="max-width: 272px;">
            <div class="product-card-image" style="margin-bottom: 30px; padding-top: 141%; background-repeat: no-repeat; background-size: 100%; background-image: url({{ $product->getPrimaryImage('thumb') }}); background-position: center center;"><img class="sr-only" src="{{ asset('images/example-product-1.png') }}" alt="" /></div>
            <h3 class="product-card-title text-dark mb-0" style="font-size: 16px; font-weight: 300; line-height: 1.56;">{{ $product->title }}</h3>
            @if (true)
              <div class="product-card-price" style="font-size: 20px;">${{ number_format($product->price, 2, ',', ' ') }}</div>
            @else
              <div class="d-flex">
                <div class="product-card-price text-primary" style="font-size: 20px;">$1000</div>
                <div class="product-card-price text-gray" style="font-size: 20px; margin-left:20px">$1999,99</div>
              </div>
            @endif
          </div>
        </a>
      @endforeach
    </div>
