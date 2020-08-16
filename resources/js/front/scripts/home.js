if ($('.home-slider').length) {
  const homeIntroSwiperParams = {};

  if($('.home-slider').find('.swiper-slide').length > 1){
    homeIntroSwiperParams.navigation = {
      nextEl: '.swiper-nav-next',
      prevEl: '.swiper-nav-prev',
    };
    homeIntroSwiperParams.pagination = {
      el: '.swiper-pagination',
      clickable: true
    };
  }
  const swiper = new Swiper('.home-slider .swiper-container', homeIntroSwiperParams);
}
