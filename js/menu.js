/**
 * showMenu() displays menu in smaller screens (max-width 932px)
 */
function showMenu() {
	$('.ui.vertical.sidebar').addClass('overlay visible');
}

/**
 * hideMenu() hides menu in smaller screens (max-width 932px)
 */
function hideMenu() {
	$('.ui.vertical.sidebar.overlay.visible').removeClass('overlay visible');
}

/**
 * toggleSubMenuVisibility() displays/hides sub menu
 *
 * @element {DOM element} element for sub menu
 */
function toggleSubMenuVisibility(element) {
	if (typeof element !== 'undefined') {
		if (element.is(':hidden')) {
			element.slideDown( "slow");
		} else {
			element.slideUp( "slow");
		}
	}
}

$(document).ready(function() {
	$('.show-menu-button').on('click', function() {
		showMenu();
	});

	$('body').on('click', function(thisElement) {
	    if ($(thisElement.target).closest('.article').length > 0) {
			hideMenu();
	    }
	});

	$('.sub-menu-header').on('click', function() {
		var thisParent = $(this).parent();
		var thisMenu = thisParent.find('.menu');
		toggleSubMenuVisibility(thisMenu);
	});

	$('#logout').on('click', function() {
		var postData = {
				type: 'logout',
				csrf_token: CSRF_TOKEN
			}
			try {
				$.ajax({
					url: 'request/auth.php',
					type: "POST",
					dataType: 'json',
					data: postData,
					success: function(response) {
						location.reload();
					}
				});
			} catch (error) {
                location.reload();
			}
	});
});
