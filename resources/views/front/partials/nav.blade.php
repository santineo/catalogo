<nav class="navbar navbar-expand-lg">
  {{-- @if ($configs->logo->image)
    <img src="{{ $configs->logo->image }}" style="max-width:180px; max-height: 80px;" alt="">
  @endif --}}
  <h1><a class="navbar-brand" href="{{ route('home') }}">{{ $configs->site_name->value }}</a></h1>
  @if (isset($noMenu))
    <div class="ml-auto text-uppercase" style="font-size: 14px; font-weight: 600;">{!! $noMenu !!}</div>
  @else
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Productos
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach (App\Category::all() as $key => $category)
              <a class="dropdown-item" href="{{ route('front.products.index', ['category' => $category->id]) }}">{{ Str::limit($category->name, 20) }}</a>
            @endforeach
          </div>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">Nosotros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Preguntas Frecuentes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('front.contacts.create') }}">Contacto</a>
        </li>
        <li class="nav-item nav-item-icon">
          <a class="nav-link nav-link-icon" href="#"><i class="icon-search"></i></a>
        </li>
        <li class="nav-item nav-item-icon">
          <a class="nav-link nav-link-icon" href="{{ route('front.cart') }}"><i class="icon-basket"></i></a>
        </li>
      </ul>
    </div>
  @endif
</nav>
