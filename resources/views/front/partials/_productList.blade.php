
    <div class="row" style="margin: 0 -33px;">
      @for ($i=0; $i < 10; $i++)
        <div class="col-lg-3 col-md-4 col-sm-6" style="padding: 0 33px; margin-bottom: 60px;">
          <a href="#" class="product-card text-decoration-none d-block" style="max-width: 272px;">
            <div class="product-card-image" style="margin-bottom: 30px; padding-top: 141%; background-image: url({{ asset('images/example-product-1.png') }}); background-position: center center;"><img class="sr-only" src="{{ asset('images/example-product-1.png') }}" alt="" /></div>
            <h3 class="product-card-title text-dark mb-0" style="font-size: 16px; font-weight: 300; line-height: 1.56;">Queso de cabra /Kg</h3>
            @if (rand(0,1))
              <div class="product-card-price" style="font-size: 20px;">$1999,99</div>
            @else
              <div class="d-flex">
                <div class="product-card-price text-primary" style="font-size: 20px;">$1000</div>
                <div class="product-card-price text-gray" style="font-size: 20px; margin-left:20px">$1999,99</div>
              </div>
            @endif
          </div>
        </a>
      @endfor
    </div>
