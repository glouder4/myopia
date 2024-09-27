function updateQueryStringParameter(uri, key, value) {
	var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
	var separator = uri.indexOf('?') !== -1 ? "&" : "?";
	if (uri.match(re)) {
		return uri.replace(re, '$1' + key + "=" + value + '$2');
	} else {
		return uri + separator + key + "=" + value;
	}
}

function Popup(data, w, h, title) {
	var mywindow = window.open('', title, 'height=' + h + ',width=' + w);
	mywindow.document.write('<html><head><title>' + title + '</title>');
	/*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
	mywindow.document.write('</head><body >');
	mywindow.document.write(data);
	mywindow.document.write('</body></html>');

	mywindow.document.close();
	// necessary for IE >= 10
	mywindow.focus();
	// necessary for IE >= 10

	mywindow.print();
	mywindow.close();

	return true;
}


$(document).ready(function() {

	$(document).on('click', '.open_doctors', function() {

		$(this).parents('.clinic').find('.clinic_doctors').slideToggle(500);
		$(this).slideUp(500);

	}).on('click', '.interval_change', function() {

		$('#shedule_form .fader').fadeIn(200);
		$('#shedule_form').data('interval', $(this).data('interval'));
		$.ajax({
			type : 'post',
			data : 'SHEDULE_INTERVAL=' + $(this).data('interval'),
			url : window.location.href,
			success : function(html) {
				$('#shedule_form').html($(html).find('#shedule_form').html());
			}
		});

	}).on('click', '#doc_days li', function() {

		$('#doc_days li.active').removeClass('active');
		$(this).addClass('active');
		$('.time.visible_time').removeClass('visible_time');
		$('.time[rel=day_' + $(this).data('dayid') + ']').addClass('visible_time');

	}).on('click', '.shedule_right_bottom .time.free', function() {

		sendUrl = updateQueryStringParameter(updateQueryStringParameter(window.location.href, 'SHEDULE_TIME', $(this).data('daytimeid')), 'SHEDULE_INTERVAL', $('#shedule_form').data('interval'));

		var dayID = $(this).attr('rel').substr(4);
		var timeID = $(this).data('daytimeid');
		var showForm = false;

		var getUrlParameter = function getUrlParameter(sParam) {
			var sPageURL = decodeURIComponent(window.location.search.substring(1)),
				sURLVariables = sPageURL.split('&'),
				sParameterName,
				i;

			for (i = 0; i < sURLVariables.length; i++) {
				sParameterName = sURLVariables[i].split('=');

				if (sParameterName[0] === sParam) {
					return sParameterName[1] === undefined ? true : sParameterName[1];
				}
			}
		};

		var doctorID = getUrlParameter('DOCTOR_ID');

		$("#exampleModal").modal('show');

		setTimeout(() => {$.ajax({
			async: false,
			url: "check.php?DAY="+dayID+"&TIME="+timeID+"&DOCTOR_ID="+doctorID,
			method: 'get',
			dataType: 'html',
			success: function(data){
				$("#exampleModal").modal('hide');
				if(data == 'OK'){
					showForm = true;
				}else{
					alert('This time is busy, please choose other time');
					window.location.reload();
				}
			}
		});

			if(showForm){
				$('#shedule_form .fader').fadeIn(200);
				$.ajax({
					type : 'post',
					url : sendUrl,
					success : function(html) {
						$('#shedule_form').html($(html).find('#shedule_form').html());
						if($('#phone-mask').length>0)
							var phoneMask = new IMask(
								document.getElementById('phone-mask'), {
									mask: '+{7}(000)000-00-00'
								});
					}
				});
			}
		}, 1000);

	}).on('submit', '#make_request_form', function(e) {

		if ( typeof e != 'undefined' && typeof e.preventDefault == 'function') {
			e.preventDefault();
		}

		$('#shedule_form .fader').fadeIn(200);
		$.ajax({
			type : 'post',
			url : $(this).attr('action'),
			data : $(this).serialize(),
			success : function(html) {
				$('#shedule_form').html($(html).find('#shedule_form').html());
			}
		});

		return false;
	}).on('click', '.voucher_print_link', function(e) {
		if ( typeof e != 'undefined' && typeof e.preventDefault == 'function') {
			e.preventDefault();
		}

		_voucher = $('#voucher');

		Popup(_voucher.prop('outerHTML'), _voucher.width(), _voucher.height(), _voucher.find('.clinic_name').text() + _voucher.find('.voucher_top_left').text());

		return false;
	});

});
