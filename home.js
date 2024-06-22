// $(window).scroll(function () {
// 	if ($(this).scrollTop() > 50) {
// 		$('header').addClass('header-bg');
// 	} else {
// 		$('header').removeClass('header-bg');
// 	}
// });
jQuery(function ($) {
	$(".af-rating-owl").owlCarousel({
		// center: true,
		items: 1,
		loop: true,
		margin: 24,
		dots: false,
		autoplay: true,
		autoplayTimeout: 4000,
		autoplayHoverPause: true,
		responsive: {
			0: {
				items: 1,
			},
			// breakpoint from 480 up
			576: {
				items: 1,
			},
			// breakpoint from 768 up
			768: {
				items: 1,
			},
			992: {
				items: 1,
			}
		}
	});


});