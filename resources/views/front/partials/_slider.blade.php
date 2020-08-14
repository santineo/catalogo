<!-- Swiper -->
<div class="swiper-container home-intro-swiper h-100 w-100">
  <div class="swiper-wrapper">
    <div class="swiper-slide position-relative">
    <div class="swiper-slide-background" style=" background-image: url({{ $slideImage }})">

    </div>
      <div class="container">
        <h2 style="margin-bottom: 45px">{{ $slideTitle }}</h2>
        @if (isset($slideButtonText) && $slideButtonText)
          <a href="{{ $slideLink }}" class="d-flex align-items-center link">
            <div class="link-arrow"><i class="icon-right"></i></div>
            <div class="link-text">{{ $slideButtonText }}</div>
          </a>
        @endif
      </div>
    </div>
    {{-- <div class="swiper-slide" style="background-image: url({{ asset('images/intro-example.png') }})"></div> --}}
    {{-- <div class="swiper-slide" style="background-image: url({{ asset('images/intro-example.png') }})"></div>
    <div class="swiper-slide" style="background-image: url({{ asset('images/intro-example.png') }})"></div> --}}
  </div>

  <div class="position-absolute w-100 home-intro-swiper-nav" style="bottom: 60px; z-index: 50;">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="swiper-pagination home-intro-swiper-nav-pagination position-relative"></div>

      {{-- IF SLIDES > 1 d-flex ELSE d-none --}}
      <div class="d-none">
        <div class="home-intro-swiper-nav-prev"><i class="icon-left"></i></div>
        <div class="home-intro-swiper-nav-next"><i class="icon-right"></i></div>
      </div>

    </div>
  </div>
</div>
