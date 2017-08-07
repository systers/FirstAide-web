describe("Tests for show error", function() {
	var msg = 'this is a test message';
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

describe("Tests for hide error", function() {
	var msg = 'this is a test message';
	beforeEach(function() {
		setFixtures('<div class="field"> \
				<div class="ui red pointing">' + msg + '</div> \
			</div>');
		hideError($('.field'));
	});

	it("should be visible", function() {
		expect($('.field')).not.toHaveClass('error');
		expect($('.ui.red.pointing')).toBeHidden();
	});
});

describe("Tests for not empty field", function() {
	var msg = 'this is a test message',
		r = false;
	beforeEach(function() {
		setFixtures('<div class="field">\
			<label>Name</label>\
			<input type="text" name="name" id="name" placeholder="Your complete name" value="Jon Snow">\
			<div class="ui basic red left pointing prompt label transition hide"></div>\
		</div>');
		r = notEmpty({ ele: $('#name'), text: msg});
	});

	it("should be visible", function() {
		expect($('.field')).not.toHaveClass('error');
		expect($('.ui.red.pointing')).toBeHidden();
		expect(r).toBeTruthy();
	});
});

describe("Tests for empty field", function() {
	var msg = 'this is a test message',
		r = false;
	beforeEach(function() {
		setFixtures('<div class="field">\
			<label>Name</label>\
			<input type="text" name="name" id="name" placeholder="Your complete name" value="">\
			<div class="ui basic red left pointing prompt label transition hide"></div>\
		</div>');
		r = notEmpty({ ele: $('#name'), text: msg});
	});

	it("should be visible", function() {
		expect($('.field')).toHaveClass('error');
		expect($('.ui.red.pointing')).toContainText(msg);
		expect($('.ui.red.pointing')).toBeVisible();
		expect(r).not.toBeTruthy();
	});
});

describe("Tests for show response", function() {
	var msg = 'this is a test message';
	jasmine.clock().install();
	beforeEach(function() {
		setFixtures('<div class="element"></div>\
		<div class="ui modal">\
			<div class="header"></div>\
			<div class="content"></div>\
			<div class="actions">\
				<div class="ui cancel green button">Close</div>\
			</div>\
		</div>');
		$('.ui.modal').hide();
		showResponse($('element'), { response: true, message: msg });
		jasmine.clock().tick(4000);
	});

	it("should be visible", function() {
		expect($('.content')).toContainText(msg);
		expect($('.ui.modal')).toBeVisible();
	});
});