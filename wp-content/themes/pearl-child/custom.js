jQuery(document).ready(function () {
	jQuery('.btn_outline').attr('target', '_blank');
	/* HUBSPOT - REQUEST A QUOTE */
	if (jQuery('.frm-request-a-quote-content').length) {
		jQuery('.frm-request-a-quote-content').parent().addClass('frm-request-a-quote');
	}
	
	jQuery(document).on('click', 'form.frm-request-a-quote .wpcf7-submit', function(e) {
		e.preventDefault();
		
		var res = "";
		var x = "";
		x = jQuery("form.frm-request-a-quote").serializeArray(); 
		jQuery.each(x, function (i, field) {
				res += i > 0 ? "&" : "";
				res += field.name + "=" + field.value;
		});
		
		res += "&name="+ 'Request a Quote';
		res += "&url="+ jQuery('form.frm-request-a-quote').attr('action');
		
		jQuery.ajax({
			type: 'POST',
			url: '/hubspot/request-a-quote.php',
			data: res,
			success: function(data) {
				if (data == 'field is required.') {
					jQuery("form.frm-request-a-quote").submit();
				} else {
					window.location.href = "https://a40632.actonsoftware.com/acton/media/40632/thank-you";
				}
			},
			error: function() {
				alert('An error occurred.');
			}
		});
	});
	/* end HUBSPOT - REQUEST A QUOTE */

    jQuery('.stm_video.stm_video_style_2').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });
		
		
	/* HUBSPOT - Subscription box */
	if (jQuery('.frm-subscription-box-content').length) {
		jQuery('.frm-subscription-box-content').parent().addClass('frm-subscription-box');
	}
	
	jQuery(document).on('click', 'form.frm-subscription-box .wpcf7-submit', function(e) {
		e.preventDefault();
		
		var res = "";
		var x = "";
		x = jQuery("form.frm-subscription-box").serializeArray(); 
		jQuery.each(x, function (i, field) {
			res += i > 0 ? "&" : "";
			res += field.name + "=" + field.value;
		});
		
		res += "&name="+ 'Subscription Box';
		res += "&url="+ jQuery('form.frm-subscription-box').attr('action');
		
		jQuery.ajax({
			type: 'POST',
			url: '/hubspot/subscription-box.php',
			data: res,
			success: function(data) {
				if (data == 'field is required.') {
					jQuery("form.frm-subscription-box").submit();
				} else {
					window.location.href = "https://a40632.actonsoftware.com/acton/media/40632/thanks-form-submitted";
				}
			},
			error: function() {
				alert('An error occurred.');
			}
		});
	});
	/* end HUBSPOT - Subscription box */
});