$(document).ready(function() {
	$('.contact-button').on('click', function() {
		var thisId = $(this).attr('id'),
			getHelpSection = $('#get-help-section'),
			getHelpActionSection = $('#get-help-action-section');
		$('#get-help-call').attr('data-info', thisId);
		$('#get-help-sms').attr('data-info', thisId);
		if ($('#content-container #' + thisId + '-container').length > 0) {
			$('#content-container').removeClass('hide');
			$('#content-container #' + thisId + '-container').removeClass('hide');
		}
        getHelpSection.fadeOut('slow');
        getHelpActionSection.delay(500).fadeIn('slow');
	});

	$('#get-help-action-section .remove.icon').on('click', function() {
		var getHelpSection = $('#get-help-section'),
		getHelpActionSection = $('#get-help-action-section');
        getHelpActionSection.fadeOut('slow');
        getHelpSection.delay(500).fadeIn('slow');
        setTimeout(function() {
			$('#content-container').addClass('hide');
        	$('#content-container > div > div').addClass('hide');
        }, 600);
	});
});
