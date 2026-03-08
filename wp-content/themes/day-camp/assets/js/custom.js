jQuery(document).ready(function () {
  var day_camp_swiper_testimonials = new Swiper(".testimonial-swiper-slider.mySwiper", {
    slidesPerView: 3,
      spaceBetween: 50,
      speed: 1000,
      autoplay: {
        delay: 3000,
        disableOnPoppinsaction: false,
      },
      navigation: {
        nextEl: ".testimonial-swiper-button-next",
        prevEl: ".testimonial-swiper-button-prev",
      },
      breakpoints: {
        0: {
          slidesPerView: 1,
        },
        767: {
          slidesPerView: 2,
        },
        1023: {
          slidesPerView: 3,
        }
    },
  });
});

jQuery(document).ready(function ($) {
  var day_camp_owl = $(".trek-section-grid.owl-carousel");

  day_camp_owl.owlCarousel({
    loop: true,
    center: true,
    items: 3,
    margin: 10,
    autoplayTimeout: 3000,
    speed: 300,
    nav: false,
    dots: true,
    rtl: false,
    autoplay: true,
    responsive: {
      0: { items: 1 },
      600: { items: 2 },
      1024: { items: 3 }
    }
  });
});

jQuery(document).ready(function ($) {
  var day_camp_owl = $(".adventure-trek-grp.owl-carousel");
  day_camp_owl.owlCarousel({
    loop: true,
    items: 3,
    margin: 20,
    nav: false,
    dots: false,
    rtl: false,
    autoplay: true,
    responsive: {
      0: { items: 1, 
        margin: 0
      },
      768: { items: 2 },
      1439: { items: 3}
    }
  });
});

jQuery(document).ready(function ($) {
    const $day_camp_itinerary = $(".wp-travel-itinerary-items.grid-view");

    if ($day_camp_itinerary.length) {
        $day_camp_itinerary.addClass("owl-carousel");

        $day_camp_itinerary.owlCarousel({
            items: 3,
            loop: true,
            margin: 30,
            nav: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1025: {
                    items: 3
                }
            }
        });
    }
});