/**
 * Suite : Tests for showing error on incorrect field entry
 * Description : This is a test suite for showing error in case of an invalid field entry
 */
describe("Tests for showing error on incorrect field entry", function() {
	var msg = 'This is a test message for showing error';
	beforeEach(function() {
		setFixtures('<div class="field"> \
				<div class="ui red pointing"></div> \
			</div>');
		showError($('.field'), msg);
	});

	it("should be visible", function() {
		expect($('.field')).toHaveClass('error');
		expect($('.ui.red.pointing')).toContainText(msg);
		expect($('.ui.red.pointing')).toBeVisible();
	});
});

/**
 * Suite : Tests for hiding error on correct field entry
 * Description : This is a test suite for hiding error in case of an valid field entry
 */
describe("Tests for hiding error on correct field entry", function() {
	var msg = 'This is a test message for not showing error';
	beforeEach(function() {
		setFixtures('<div class="field error"> \
				<div class="ui red pointing">' + msg + '</div> \
			</div>');
		hideError($('.field'));
	});

	it("should be visible", function() {
		expect($('.field')).not.toHaveClass('error');
		expect($('.ui.red.pointing')).toBeHidden();
	});
});
