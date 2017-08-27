/**
 * Suite : Tests for showing next segment
 * Description : This is a test suite for testing if the next segment of the page
 * with different cards is visible
 */
describe("Tests for showing next segment", function() {
	var current = 0;
	beforeEach(function() {
		setFixtures('<div class="previous-button hide"></div>\
			<div>\
				<div class="ui column center grid multi-segment"></div>\
				<div class="ui column center grid multi-segment hide"></div>\
				<div class="ui column center grid multi-segment hide"></div>\
			</div>\
			<div class="next-button"></div>');

		// mock function
		spyOn($.fn, "show").and.callFake(function() {
			$(this).addClass('hide');
    	});
		spyOn($.fn, "hide").and.callFake(function() {
			$(this).removeClass('hide');
    	});
		current = nextSegment(current);
	});

	it("next segment should be visible", function() {
		expect(current).toBe(1);
		expect($('.ui.grid.multi-segment')[current-1]).toHaveClass('hide');
		expect($('.ui.grid.multi-segment')[current]).not.toHaveClass('hide');
		expect($(".previous-button")).toBeTruthy();
	});
});

/**
 * Suite : Tests for showing previous segment
 * Description : This is a test suite for testing if the previous segment of the page
 * with different cards is visible
 */
describe("Tests for showing previous segment", function() {
	var current = 3;
	beforeEach(function() {
		setFixtures('<div class="previous-button"></div>\
			<div>\
				<div class="ui column center grid multi-segment hide"></div>\
				<div class="ui column center grid multi-segment hide"></div>\
				<div class="ui column center grid multi-segment"></div>\
			</div>\
			<div class="next-button hide"></div>');

		// mock function
		spyOn($.fn, "show").and.callFake(function() {
			$(this).addClass('hide');
    	});
		spyOn($.fn, "hide").and.callFake(function() {
			$(this).removeClass('hide');
    	});
		current = previousSegment(current);
	});

	it("previous segment should be visible", function() {
		expect(current).toBe(2);
		expect($('.ui.grid.multi-segment')[current-1]).toHaveClass('hide');
		expect($('.ui.grid.multi-segment')[current]).not.toHaveClass('hide');
		expect($(".next-button").hasClass('hide')).toBeTruthy();
	});
});
