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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <!-- Styles -->
  <link href="{{ asset('css/front.css') }}" rel="stylesheet">
</head>
<body class="bg-white">
  <div id="front">

    <div class="wrapper">
        <main>

          <div style="min-height: calc(100vh - 170px);">
            <div class="container">
              <alert :class="'mb-3'"></alert>
            </div>
            @yield('content')
          </div>

          @if (!isset($noFooter))
            @include('front.partials.footer')
          @endif

          {{-- <cart :token="{{ isset($token) ? "'$token'" : 'false' }}" :show="{{ isset($hideCart) && $hideCart ? 'false' : 'true' }}" /> --}}
        </main>

    </div>

  </div>
</body>
</html>
