<footer class="container border-top footer">
    <div class="row">

      <div class="col-lg-4 col-lg-6">
        <h2 class="footer-title">{{ $configs->site_name->value }}</h2>
        <p class="footer-description">{{ $configs->description->value }}</p>

        @include('front.partials.social')
      </div>

      <div class="col-lg-4 col-lg-6 ml-auto">
        <div class="d-flex justify-content-between">

          <div class="footer-list">
            <h4 class="footer-list-title">@lang('messages.footer_shop')</h4>
            <ul class="list-unstyled">
              @foreach (App\Category::productOrder()->take(4)->get() as $key => $category)
                <li ><a href="{{ route('front.products.index', ['category' => $category->id]) }}">{{ Str::limit($category->name, 20) }}</a></li>
              @endforeach
            </ul>
          </div>

          @if ($configs->email->value || $configs->phone->value)
            <div class="footer-list">
              <h4 class="footer-list-title">@lang('messages.footer_contact')</h4>
              <ul class="list-unstyled">
                @if ($configs->email->value)
                  <li><a href="mailto:{{ str_replace(' ', '', $configs->email->value) }}">{{ $configs->email->value }}</a></li>
                @endif
                @if ($configs->phone->value)
                  <li>@lang('messages.footer_phone') <a href="tel:{{ str_replace(' ', '', $configs->phone->value) }}">{{ $configs->phone->value }}</a></li>
                @endif
              </ul>
            </div>
          @endif

        </div>
      </div>

    </div>
  </footer>
