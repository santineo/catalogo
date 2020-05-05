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
  <script src="{{ asset('js/front.js') }}" defer></script>

  <!-- Styles -->
  <link href="{{ asset('css/front.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
  <div id="front">

    <div class="wrapper">

        <main>
          @include('front.partials.nav')

          <div class="py-4">
            <div class="container">
              <alert :class="'mb-3'"></alert>
            </div>
            @yield('content')
          </div>

          @include('front.partials.footer')

          <cart :token="{{ isset($token) ? "'$token'" : 'false' }}" :show="{{ isset($hideCart) && $hideCart ? 'false' : 'true' }}" />
        </main>

    </div>

  </div>
</body>
</html>
