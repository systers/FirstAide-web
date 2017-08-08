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

describe("Tests for success response modal", function() {
	var msg = 'this is a test message';
	beforeEach(function() {
		jasmine.clock().install();
		setFixtures('<div class="element"></div>\
		<div class="processing"></div>\
		<div class="ui modal">\
			<div class="header"></div>\
			<div class="content"></div>\
			<div class="actions">\
				<div class="ui cancel green button">Close</div>\
			</div>\
		</div>');
		$('.ui.modal').hide();

		// mock modal show call
		spyOn($.fn, "modal").and.returnValue($('.ui.modal').show());
		showResponse($('element'), { response: true, message: msg });
		jasmine.clock().tick(4000);
	});

	afterEach(function() {
		jasmine.clock().uninstall();
	});

	it("should be visible", function() {
		expect($('.content')).toContainText(msg);
		expect($('.ui.modal')).toBeVisible();
	});
});

describe("Tests for failed response modal", function() {
	var msg = 'this is a test message';
	beforeEach(function() {
		jasmine.clock().install();
		setFixtures('<div class="element"></div>\
		<div class="ui modal">\
			<div class="header"></div>\
			<div class="content"></div>\
			<div class="actions">\
				<div class="ui cancel green button">Close</div>\
			</div>\
		</div>');
		$('.ui.modal').hide();

		// mock modal show call
		spyOn($.fn, "modal").and.returnValue($('.ui.modal').show());
		showResponse($('element'), { response: false, message: msg });
		jasmine.clock().tick(4000);
	});

	afterEach(function() {
		jasmine.clock().uninstall();
	});

	it("should be visible", function() {
		expect($('.content')).toContainText(msg);
		expect($('.header')).toContainText('Are you lost?');
		expect($('.ui.modal')).toBeVisible();
	});
});

describe("Tests for password score", function() {
	it("should be visible", function() {
		var passwords = {
			0: {
				'text': 'psswd',
				'score': 0
			},
			1: {
				'text': 'password',
				'score': 2
			},
			2: {
				'text': 'Password',
				'score': 3
			},
			3: {
				'text': 'password1',
				'score': 3
			},
			4: {
				'text': 'password#',
				'score': 3
			},
			5: {
				'text': 'Password1',
				'score': 4
			},
			6: {
				'text': 'Password#',
				'score': 4
			},
			7: {
				'text': 'Password#1',
				'score': 5
			},
			8: {
				'text': 'Password3#',
				'score': 5
			}
		}
		for (var k in passwords) {
			if (passwords.hasOwnProperty(k)) {
				var s = passwordScore(passwords[k]['text']);
				expect(s['score']).toBe(passwords[k]['score']);
			}
		}
	});
});


describe("Tests for password field", function() {
	beforeEach(function() {
		setFixtures('<div class="field">\
			<label>Password</label>\
			<input type="text" name="name" id="password" value="test">\
			<div class="ui basic red left pointing prompt label transition hide"></div>\
		</div>\
		<div class="field password-strength">\
			<div id="password-strength-status" data-percent="0"></div>\
		</div>');

		spyOn($.fn, "progress").and.callFake(function() {
			$('#password-strength-status').data('percent',arguments[0]['percent']);
		});
	});

	it("should be visible", function() {

		var passwords = {
			0: {
				'text': 'psswd',
				'percent': 25
			},
			1: {
				'text': 'password',
				'percent': 45
			},
			2: {
				'text': 'Password',
				'percent': 75
			},
			3: {
				'text': 'password1',
				'percent': 75
			},
			4: {
				'text': 'password#',
				'percent': 75
			},
			5: {
				'text': 'Password1',
				'percent': 95
			},
			6: {
				'text': 'Password#',
				'percent': 95
			},
			7: {
				'text': 'Password#1',
				'percent': 95
			},
			8: {
				'text': 'Password3#',
				'percent': 95
			}
		}
		for (var k in passwords) {
			$('.field.password-strength').hide();
			if (passwords.hasOwnProperty(k)) {
				$('#password').val(passwords[k]['text']);

				expect($('.field.password-strength')).toBeHidden();
				passwordKeyUp($('#password'));
				expect($('.field.password-strength')).toBeVisible();
				expect($('#password-strength-status').data('percent')).toBe(passwords[k]['percent']);
			}
		}
	});
});