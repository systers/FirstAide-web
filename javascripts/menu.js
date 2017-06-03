$('.sub-menu-header').click(function() {
	var thisParent = $(this).parent();
	var thisMenu = thisParent.find('.menu');
	if (thisMenu.is(':hidden')) {
		thisParent.find('.menu').slideDown( "slow");
	} else {
		thisParent.find('.menu').slideUp( "slow");
	}
});