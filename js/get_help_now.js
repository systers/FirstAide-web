/**
 * showGetHelpActionSection() displays the page section
 * where the user has options to seek help
 * such as call or message
 */
function showGetHelpActionSection () {
	var getHelpSection = $('#get-help-section'),
		getHelpActionSection = $('#get-help-action-section');
    getHelpSection.fadeOut('slow');
    getHelpActionSection.delay(500).fadeIn('slow');
}

/**
 * hideGetHelpActionSection() hides the get help page section
 * and navigate to other section
 */
function hideGetHelpActionSection() {
	var getHelpSection = $('#get-help-section'),
		getHelpActionSection = $('#get-help-action-section');
    getHelpActionSection.fadeOut('slow');
    getHelpSection.delay(500).fadeIn('slow');
    setTimeout(function() {
		$('#content-container').addClass('hide');
    	$('#content-container > div > div').addClass('hide');
    }, 600);
}
$(document).ready(function() {
	$('.contact-button').on('click', function() {
		var thisId = $(this).attr('id');
		$('#get-help-call').attr('data-info', thisId);
		$('#get-help-sms').attr('data-info', thisId);
		if ($('#content-container #' + thisId + '-container').length > 0) {
			$('#content-container').removeClass('hide');
			$('#content-container #' + thisId + '-container').removeClass('hide');
		}
		showGetHelpActionSection();
	});

	$('#get-help-action-section .remove.icon').on('click', function() {
		hideGetHelpActionSection();
	});
});
