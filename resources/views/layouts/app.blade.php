<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Catalogo') }}</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app">

    <div class="wrapper d-flex w-100">


      <sidebar class="sidebar bg-dark text-light pt-3">
        <a class="text-light h2 font-weight-bold text-uppercase pl-4" href="{{ url('/') }}">
            {{ config('app.name', 'Catalogo') }}
        </a>
        <ul class="list-unstyled mt-5">
          <li class="py-3 pl-4 border-top"><a class="d-block text-light text-uppercase font-weight-bold" href="/administracion"><i class="fas fa-home pr-3"></i>Dashboard</a></li>
          <li class="py-3 pl-4 border-top"><a class="d-block text-light text-uppercase font-weight-bold" href="{{ route('productos.index') }}"><i class="fab fa-product-hunt pr-3"></i>Productos</a></li>
          <li class="py-3 pl-4 border-top"><a class="d-block text-light text-uppercase font-weight-bold" href="{{ route('marcas.index') }}"><i class="fas fa-trademark pr-3"></i>Marcas</a></li>
          <li class="py-3 pl-4 border-top border-bottom"><a class="d-block text-light text-uppercase font-weight-bold" href="{{ route('categorias.index') }}"><i class="far fa-list-alt pr-3"></i>Categorías</a></li>
        </ul>
      </sidebar>

        <main class="main w-100">
          @include('admin.partials.nav')
          <div class="content py-5">
          @yield('content')
        </div>
        </main>

    </div>

  </div>
</body>
</html>
