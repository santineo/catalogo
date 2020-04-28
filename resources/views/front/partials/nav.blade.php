<nav class="navbar navbar-dark bg-primary">
  <div class="container">
    {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> --}}
    <div class="d-flex align-items-center justify-content-between w-100">

      <a class="navbar-brand" href="{{ route('home') }}">Hidden brand</a>

      <form class="form-inline my-2 my-lg-0" action="{{ route('front.products.index') }}">
        <input class="form-control rounded-0 border-top-0 border-bottom-0" name="term" value="{{ request('term', '') }}" type="search" placeholder="Buscar" aria-label="Buscar">
        <button class="btn btn-dark rounded-0" type="submit"><i class="fas fa-search"></i></button>
      </form>

      <div class="d-flex align-items-center">
        <a href="#" class="text-white">Contacto</a>
      </div>
    </div>
  </div>
</nav>
