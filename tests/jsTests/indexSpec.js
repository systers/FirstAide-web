/**
 * Suite : Tests for not empty field
 * Description : This is a test suite for checking when field is not empty
 */
describe("Tests for not empty field", function() {
	var msg = 'This is a test message when field is not empty',
		isNotEmpty = false;
	beforeEach(function() {
		setFixtures('<div class="field">\
			<label>Name</label>\
			<input type="text" name="name" id="name" placeholder="Your complete name" value="Jon Snow">\
			<div class="ui basic red left pointing prompt label transition hide"></div>\
		</div>');
		isNotEmpty = notEmpty({ element: $('#name'), text: msg});
	});

	it("should be visible", function() {
		expect($('.field')).not.toHaveClass('error');
		expect($('.ui.red.pointing')).toBeHidden();
		expect(isNotEmpty).toBeTruthy();
	});
});

/**
 * Suite : Tests for empty field
 * Description : This is a test suite for checking when feild is empty
 */
describe("Tests for empty field", function() {
	var msg = 'This is a test message when input field is empty',
		isNotEmpty = false;
	beforeEach(function() {
		setFixtures('<div class="field">\
			<label>Name</label>\
			<input type="text" name="name" id="name" placeholder="Your complete name" value="">\
			<div class="ui basic red left pointing prompt label transition hide"></div>\
		</div>');
		isNotEmpty = notEmpty({ element: $('#name'), text: msg});
	});

	it("should be visible", function() {
		expect($('.field')).toHaveClass('error');
		expect($('.ui.red.pointing')).toContainText(msg);
		expect($('.ui.red.pointing')).toBeVisible();
		expect(isNotEmpty).not.toBeTruthy();
	});
});

/**
 * Suite : Tests for success response modal
 * Description : This is a test suite for checking when the response is a success
 */

describe("Tests for success response modal", function() {
	var msg = 'This is a test message when the response is a success';
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

/**
 * Suite : Tests for failed response modal
 * Description : This is a test suite for a failed response modal
 */
describe("Tests for failed response modal", function() {
	var msg = 'This is a test message for a failed response modal';
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

/**
 * Suite : Tests for password score
 * Description : This is a test suite for checking password score
 */
describe("Tests for password score", function() {
	it("should be visible", function() {
		var passwords = {
			0: {
				'text': 'psswd',
                'errorCount': 4,
				'score': 0
			},
			1: {
				'text': 'password',
                'errorCount': 3,
				'score': 2
			},
			2: {
				'text': 'Password',
                'errorCount': 2,
				'score': 3
			},
			3: {
				'text': 'password1',
                'errorCount': 2,
				'score': 3
			},
			4: {
				'text': 'password#',
                'errorCount': 2,
				'score': 3
			},
			5: {
				'text': 'Password1',
                'errorCount': 1,
				'score': 4
			},
			6: {
				'text': 'Password#',
                'errorCount': 1,
				'score': 4
			},
			7: {
				'text': 'Password#1',
                'errorCount': 0,
				'score': 5
			},
			8: {
				'text': 'Password3#',
                'errorCount': 0,
				'score': 5
			}
		}
		for (var key in passwords) {
			if (passwords.hasOwnProperty(key)) {
				var s = passwordScore(passwords[key]['text']);
				expect(s['score']).toBe(passwords[key]['score']);
				expect(s['error'].length).toBe(passwords[key]['errorCount']);
			}
		}
	});
});

/**
 * Suite : Tests for password field
 * Description : Unit test to verify password with varying character limits to analyze strength progress bar percentage based on score
 */
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
				passwordFieldKeyUp($('#password'));
				expect($('.field.password-strength')).toBeVisible();
				expect($('#password-strength-status').data('percent')).toBe(passwords[k]['percent']);
			}
		}
	});
});
