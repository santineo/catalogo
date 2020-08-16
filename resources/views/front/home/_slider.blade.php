<!-- Swiper -->
<section id="slider" class="home-slider">

  <div class="swiper-container swiper">
    <div class="swiper-wrapper">
      
      <div class="swiper-slide position-relative">
        <div class="swiper-slide-background" style=" background-image: url({{ $home->slider_image->image }})"></div>
        <div class="container">
          <h2 class="swiper-slide-title">{{ $home->slider_title->value }}</h2>
          @if ($home->slider_button_link->value && $home->slider_button_text->value)
            <a href="{{ $home->slider_button_link->value }}" class="d-flex align-items-center link">
              <div class="link-arrow"><i class="icon-right"></i></div>
              <div class="link-text">{{ $home->slider_button_text->value }}</div>
            </a>
          @endif
        </div>
      </div>

    </div>

    <div class="swiper-nav">
      <div class="container d-flex align-items-center justify-content-between">

        <div class="swiper-pagination"></div>

        {{-- IF SLIDES > 1 d-flex ELSE d-none --}}
        <div class="d-none">
          <div class="swiper-nav-prev"><i class="icon-left"></i></div>
          <div class="swiper-nav-next"><i class="icon-right"></i></div>
        </div>

      </div>
    </div>
  </div>
</section>
