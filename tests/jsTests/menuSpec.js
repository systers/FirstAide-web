/**
 * Suite : Tests for showing and hiding of menu
 * Description : This is a test suite for showing and hiding menu for smaller screens.
 */
describe("Tests for show and hide menu", function() {
	beforeEach(function() {
		setFixtures('<body> \
			<div class="article"> \
				<div class="ui vertical sidebar"></div> \
				<div class="show-menu-button"></div> \
			</div> \
		</body>');
	});

	it("should have visible class", function() {
		showMenu();
		expect($('.ui.vertical.sidebar')).toHaveClass('overlay');
		expect($('.ui.vertical.sidebar')).toHaveClass('visible');
	});

	it("should not have visible class", function() {
		hideMenu();
		expect($('.ui.vertical.sidebar')).not.toHaveClass('overlay');
		expect($('.ui.vertical.sidebar')).not.toHaveClass('visible');
	});
});

/**
 * Suite : Tests for showing sub menu items
 * Description : This is a test suite for showing sub menu items inside menu.
 */
describe("Tests to show sub menu", function() {
	beforeEach(function() {
		setFixtures('<div class="sub-menu-item"> \
			<div class="item sub-menu-header">Test Sub Menu Header</div> \
			<div class="menu"> \
				<a class="item" href="#">Personal Security Strategies</a> \
			</div> \
		</div>');
		$('.menu').hide();
		toggleSubMenuVisibility($('.menu'));
	});

	it("should show sub menu", function() {
		expect($('.menu')).not.toBeHidden();
	});
});

/**
 * Suite : Tests for hiding sub menu items
 * Description : This is a test suite for hiding sub menu items inside menu.
 */
describe("Tests to hide sub menu", function() {
	beforeEach(function() {
		jasmine.clock().install();
		setFixtures('<div class="sub-menu-item"> \
			<div class="item sub-menu-header">Test Sub Menu Header</div> \
			<div class="menu"> \
				<a class="item" href="#">Personal Security Strategies</a> \
			</div> \
		</div>');


		// mock slideUp function
		spyOn($.fn, "slideUp").and.callFake(function(arguments) {
			$('.menu').hide();
    	});
		$('.menu').show();
		toggleSubMenuVisibility($('.menu'));
		jasmine.clock().tick(4000);
	});

	it("should show sub menu", function() {
		expect($('.menu')).toBeHidden();
	});

	afterEach(function() {
		jasmine.clock().uninstall();
	});
});
