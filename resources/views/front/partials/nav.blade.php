<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <div class="d-flex align-items-center justify-content-between w-100">

      <a class="navbar-brand" href="{{ route('home') }}">{{ env('APP_NAME') }}</a>

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
          </ul>
        </div>
        <div class="d-flex align-items-center">
          <a href="/cart" class="text-white d-inline-block d-md-none"><span>@{{ Cart.products.length }}</span> <i class="fas fa-shopping-cart"></i></a>
        </div>
    </div>
    </div>
  </div>
</nav>
