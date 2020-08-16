<section class="home-categories" id="categories">
  <div class="container">
    <div class="row no-gutters">

      @for ($i=1; $i < 3; $i++)
        @if ($home->{"category_$i"}->category())
          <div class="col-md-6">
            <div class="home-categories-card">
              <div class="home-categories-card-image" style="background-image: url({{ $home->{"category_image_$i"}->image }})"></div>
              <div class="home-categories-card-body">
                <h3 class="home-categories-card-title">{{ $home->{"category_$i"}->category->name }}</h3>
                <a href="{{ route('front.products.index', ['category' => $home->{"category_$i"}->category->id]) }}" class="btn btn-rounded btn-black">@lang('messages.shared_seeProducts')</a>
              </div>
            </div>
          </div>
        @endif
      @endfor

    </div>
  </div>
</section>
