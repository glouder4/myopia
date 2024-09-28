jQuery(document).ready(function($){
	console.log('init owl')
	$("#endpage-slider .owl-carousel").owlCarousel({
		loop:true,
		nav: true,
		margin:30,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:3
			},
			1000:{
				items: 4
			},
			1400:{
				items: 5
			}
		},
		navText: [
			'<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none"> <circle cx="20" cy="20" r="20" fill="#212223" fill-opacity="0.5"/> <path d="M23 11.5L14.5 20L23 28.5" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
			'<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none"> <circle cx="20" cy="20" r="20" transform="matrix(-1 0 0 1 40 0)" fill="#212223" fill-opacity="0.5"/> <path d="M17 11.5L25.5 20L17 28.5" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/> </svg>'
		]
	});
});