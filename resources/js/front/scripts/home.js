const homeIntroSwiperParams = {};

if($('.home-intro-swiper').find('.swiper-slide').length > 1){
  homeIntroSwiperParams.navigation = {
    nextEl: '.home-intro-swiper-nav-next',
    prevEl: '.home-intro-swiper-nav-prev',
  };
  homeIntroSwiperParams.pagination = {
    el: '.swiper-pagination',
    clickable: true
  };
}
const swiper = new Swiper('.home-intro-swiper', homeIntroSwiperParams);
