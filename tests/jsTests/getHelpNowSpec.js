/**
 * Suite : Tests for show get help action section
 * Description : This is a test suite for checking if the get-help-action section (call/sms) is visible
 */
describe("Tests for show get help action section", function() {
	beforeEach(function() {
		jasmine.clock().install();
		setFixtures('<div id="get-help-section"></div> \
				<div id="get-help-action-section"></div>');
		spyOn($.fn, "fadeOut").and.callFake(function() {
			$(this).hide();
		});
		spyOn($.fn, "fadeIn").and.callFake(function() {
			$(this).show();
		});
		showGetHelpActionSection();
		// creating delay of 400ms
		jasmine.clock().tick(4000);
	});

	it("should display get-help-action-section and hide other sections", function() {
		expect($('#get-help-section')).toBeHidden();
		expect($('#get-help-action-section')).toBeVisible();
	});

	afterEach(function() {
		jasmine.clock().uninstall();
	});
});

/**
 * Suite : Tests for hide get help action section
 * Description : This is a test suite for checking if the get-help-section is visible 
 */
describe("Tests for hide get help action section", function() {
	beforeEach(function() {
		jasmine.clock().install();
		setFixtures('<div id="get-help-section"></div> \
				<div id="get-help-action-section"> \
					<div id="content-container"> \
						<div> \
							<div></div> \
						</div> \
					</div> \
				</div>');
		spyOn($.fn, "fadeOut").and.callFake(function() {
			$(this).hide();
		});
		spyOn($.fn, "fadeIn").and.callFake(function() {
			$(this).show();
		});
		hideGetHelpActionSection();
		// creating delay of 400ms
		jasmine.clock().tick(4000);
	});

	it("should display get-help-section and hide other sections", function() {
		expect($('#get-help-section')).toBeVisible();
		expect($('#get-help-action-section')).toBeHidden();
		expect($('#content-container')).toHaveClass('hide')
		expect($('#content-container > div > div')).toHaveClass('hide')
	});

	afterEach(function() {
		jasmine.clock().uninstall();
	});
});