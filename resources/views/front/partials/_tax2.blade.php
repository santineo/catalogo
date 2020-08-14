<section class="tax2">
  <div class="container">
    <div class="row no-gutters">
      @if (isset($tax[0]) && $tax[0]['category'] instanceof App\Category)
      <div class="col-md-6">@include('front.partials._taxCard', ['image' => $tax[0]['image'], 'title' => $tax[0]['category']->name, 'link' => route('front.products.index', ['category' => $tax[0]['category']->id])])</div>
      @endif
      @if (isset($tax[1]) && $tax[1]['category'] instanceof App\Category)
      <div class="col-md-6">@include('front.partials._taxCard', ['image' => $tax[1]['image'], 'title' => $tax[1]['category']->name, 'link' => route('front.products.index', ['category' => $tax[1]['category']->id])])</div>
      @endif
    </div>
  </div>
</section>
