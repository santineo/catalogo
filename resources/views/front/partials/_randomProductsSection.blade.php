<hr>
<section class="py-4">
  <div class="container">
  <h3 class="mb-4">Te puede interesar...</h3>
    <div class="row">
      @foreach (\App\Product::withStock()->inRandomOrder()->take(4)->get() as $key => $product)
        @include('front.partials._productCard', compact($product))
      @endforeach
    </div>
  </div>
</section>
