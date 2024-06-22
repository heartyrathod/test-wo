window.onload = function () {
  function updateScroll() {
    var ccBanner = jQuery("#cc-banner").height();
    var scroll = jQuery(window).scrollTop();
    if (scroll >= 80) {
      jQuery(".cc-header").addClass("cc-scroll");
    }
    else {
      jQuery(".cc-header").removeClass("cc-scroll");
    }
  } //missing );
  jQuery(function () {
    jQuery(window).scroll(updateScroll);
    updateScroll();
  });
  //sucess stories
  jQuery('.cc-activities-slide').owlCarousel({
    center: false,
    items: 4,
    loop: true,
    margin: 24,
    dots: false,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    autoplaySpeed: 500,
    responsive: {
      0: {
        items: 1,
      },
      575: {
        items: 2,
      },
      767: {
        items: 3,
      },
      991: {
        items: 4
      }
    }
  });
  jQuery('.cc-awards-slide').owlCarousel({
    center: false,
    items: 4,
    loop: false,
    margin: 24,
    dots: false,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    autoplaySpeed: 500,
    responsive: {
      0: {
        items: 1,
      },
      575: {
        items: 2,
      },
      767: {
        items: 3,
      },
      991: {
        items: 4
      }
    }
  });
  //aos
  AOS.init({
    easing: 'ease-out-back',
    once: true,
  });

};