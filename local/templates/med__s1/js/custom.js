jQuery(document).ready(function($) {
$('#photo-carousel').carousel({

        interval: 5000
});

$('#carousel-text').html($('#slide-content-0').html());

//Handles the carousel thumbnails

$('[id^=carousel-selector-]').click( function(){
        var id_selector = $(this).attr("id");
        var id = id_selector.substr(id_selector.length -1);
        var id = parseInt(id);
        $('#photo-carousel').carousel(id);

});

// When the carousel slides, auto update the text

$('#photo-carousel').on('slid.bs.carousel', function (e) {
         var id = $('.item.active').data('slide-number');
        $('#carousel-text').html($('#slide-content-'+id).html());
});
});

$(document).ready(function(){
	$(".toggle-all-section").hide();
	$(".toggle-button-section").click(function(){
		$(".toggle-all-section").toggle();
	});
	$('ul.menu_flex.hover').flexMenu();
	$('ul.menu_flex.click').flexMenu({
		showOnHover: false,
		'cutoff': 2,
		cutoff: 2,
	});

	$('#bs-example-navbar-collapse-1').css('opacity','1');


	/**
	 * Маска телефона
	 */
	if($('#phone-mask').length>0)
	var phoneMask = new IMask(
		document.getElementById('phone-mask'), {
			mask: '+{7}(000)000-00-00'
		});
	$('.auth_panel').on({
		'mouseenter':function(){
			//alert('x');
			$('.auth_panel_submenu').fadeIn();
		},'mouseleave':function(){
			$('.auth_panel_submenu').fadeOut();
		}
	});
});



