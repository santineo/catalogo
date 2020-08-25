<div class="site-navbar">
  <div class="container">
  <nav class="navbar navbar-expand-lg">
    {{-- @if ($configs->logo->image)
    <img src="{{ $configs->logo->image }}" style="max-width:180px; max-height: 80px;" alt="">
  @endif --}}
  <h1><a class="navbar-brand" href="{{ route('home') }}">{{ $configs->site_name->value }}</a></h1>
  @if (isset($noMenu))
    <div class="ml-auto text-uppercase navbar-no-menu">{!! $noMenu !!}</div>
  @else
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="javascript: void(0)" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @lang('messages.navbar_products')
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach (App\Category::productOrder()->get() as $key => $category)
              <a class="dropdown-item" href="{{ route('front.products.index', ['category' => $category->id]) }}">{{ Str::limit($category->name, 20) }}</a>
            @endforeach
          </div>
        </li>
        {{--
        <li class="nav-item active">
            <a class="nav-link" href="#">@lang('messages.navbar_our')</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="#">@lang('messages.navbar_faq')</a>
        </li> --}}
        <li class="nav-item">
          <a class="nav-link" href="{{ route('front.contacts.create') }}">@lang('messages.navbar_contact')</a>
        </li>
      </ul>

      <nav-search label="@lang('messages.navbar_search_label')" placeholder="@lang('messages.navbar_search_placeholder')" aria="@lang('messages.navbar_search_aria')"></nav-search>

      <a class="navbar-icon navbar-icon-cart" href="{{ route('front.cart') }}">
        <i class="icon-basket"></i>
        <span class="sr-only">@lang('messages.navbar_cart')</span>
        <div class="cart-products-count" :class="{'more-10': Cart.products.length > 9}" v-if="Cart.products.length">
          @{{ Cart.products.length }}
        </div>
      </a>

    </div>
  @endif
</nav>

  </div>
</div>
