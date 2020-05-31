<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <div class="d-flex align-items-center justify-content-between w-100">

      <h1>
        <a class="navbar-brand" href="{{ route('home') }}">
          @if ($configs->logo->image)
            <img src="{{ $configs->logo->image }}" style="max-width:80px" alt="">
          @endif
          <span class="{{ $configs->logo->image ? 'sr-only' : '' }}">{{ $configs->site_name->value }}</span>
        </a>
      </h1>

      <form class="form-inline my-2 my-lg-0 navbar-search" action="{{ route('front.products.index') }}">
        <input class="form-control rounded-0 border-top-0 border-bottom-0" name="term" value="{{ request('term', '') }}" type="search" placeholder="Buscar" aria-label="Buscar">
        <button class="btn btn-dark rounded-0" type="submit"><i class="fas fa-search"></i></button>
      </form>

      <div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTop" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTop">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">


            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="javacript: void(0)" id="navbarDropdownMenuCategories" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Productos
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuCategories">
                @foreach (App\Category::all() as $key => $category)
                  <a class="dropdown-item" href="{{ route('front.products.index', ['category' => $category->id]) }}">{{ Str::limit($category->name, 20) }}</a>
                @endforeach
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('front.contacts.create') }}">Contacto</a>
            </li>

            @if ($configs->facebook->value)
              <li class="nav-item">
                <a class="nav-link nav-link-social" target="_blank" href="{{ $configs->facebook->value }}"><i class="fab fa-facebook"></i><span class="sr-only">Facebook</span></a>
              </li>
            @endif

            @if ($configs->instagram->value)
              <li class="nav-item">
                <a class="nav-link nav-link-social" target="_blank" href="{{ $configs->instagram->value }}"><i class="fab fa-instagram"></i><span class="sr-only">Instagram</span></a>
              </li>
            @endif

            @if ($configs->youtube->value)
              <li class="nav-item">
                <a class="nav-link nav-link-social" target="_blank" href="{{ $configs->youtube->value }}"><i class="fab fa-youtube"></i><span class="sr-only">Youtube</span></a>
              </li>
            @endif

            @if ($configs->pinterest->value)
              <li class="nav-item">
                <a class="nav-link nav-link-social" target="_blank" href="{{ $configs->pinterest->value }}"><i class="fab fa-pinterest"></i><span class="sr-only">Pinterest</span></a>
              </li>
            @endif

          </ul>
        </div>
        <div class="d-flex align-items-center">
          <a href="/cart" class="text-white d-inline-block d-md-none"><span>@{{ Cart.products.length }}</span> <i class="fas fa-shopping-cart"></i></a>
        </div>
      </div>
    </div>
  </div>
</nav>
