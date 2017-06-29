$('.show-menu-button').on('click', function() {
	$('.ui.vertical.sidebar').addClass('overlay visible');
});
$('body').on('click', function(e) {
    if ($(e.target).closest('.article').length > 0) {
		$('.ui.vertical.sidebar.overlay.visible').removeClass('overlay visible');
    }
});

$('.sub-menu-header').on('click', function() {
	var thisParent = $(this).parent();
	var thisMenu = thisParent.find('.menu');
	if (thisMenu.is(':hidden')) {
		thisMenu.slideDown( "slow");
	} else {
		thisMenu.slideUp( "slow");
	}
});
