function updateScroll() {
	var ccBanner = $("#cc-banner").height();
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
$('.cc-testimonials-slide').owlCarousel({
	center: true,
	items: 3,
	loop: true,
	margin: 0,
	dots: true,
	autoplay: true,
	autoplayTimeout: 5000,
	autoplayHoverPause: true,
	autoplaySpeed: 500,
	responsive: {
		0: {
			items: 1,
		},
		575: {
			items: 1,
		},
		767: {
			items: 2,
		},
		991: {
			items: 3
		}
	}
});
//aos
AOS.init({
	easing: 'ease-out-back',
	once: true,
});
//end aos