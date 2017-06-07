$('.sub-menu-header').click(function() {
	var thisParent = $(this).parent();
	var thisMenu = thisParent.find('.menu');
	if (thisMenu.is(':hidden')) {
		thisMenu.slideDown( "slow");
	} else {
		thisMenu.slideUp( "slow");
	}
});
