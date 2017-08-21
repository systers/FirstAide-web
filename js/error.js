/**
 * showError() displays error divisions
 * with given message(msg)
 * for a short span of time inside given element
 *
 * @element {DOM element} element in which error will be shown
 * @msg {string} The message to be displayed for the error
 */
function showError(element, msg) {
	if (typeof element !== 'undefined') {
		element.addClass('error');
		element.find('.ui.red.pointing').text(msg);
		element.find('.ui.red.pointing').show();
		setTimeout(function() {element.find('.ui.red').hide();}, 7000);
	}
}

/**
 * hideError() hides error divisions
 * inside given element
 *
 * @element {DOM element} element where the error will be hidden
 */
function hideError(element) {
	if (typeof element !== 'undefined') {
		element.removeClass('error');
		element.find('.ui.red.pointing').hide();
	}
}
