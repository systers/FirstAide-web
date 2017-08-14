function showMenu() {
	$('.ui.vertical.sidebar').addClass('overlay visible');
}

function hideMenu() {
	$('.ui.vertical.sidebar.overlay.visible').removeClass('overlay visible');
}

function toggleSubMenuVisibility(ele) {
	if (ele.is(':hidden')) {
		ele.slideDown( "slow");
	} else {
		ele.slideUp( "slow");
	}
}

$('.show-menu-button').on('click', function() {
	showMenu();
});

$('body').on('click', function(e) {
    if ($(e.target).closest('.article').length > 0) {
		hideMenu();
    }
});

$('.sub-menu-header').on('click', function() {
	var thisParent = $(this).parent();
	var thisMenu = thisParent.find('.menu');
	toggleSubMenuVisibility(thisMenu);
});
