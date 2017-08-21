/**
 * Suite : Tests for success response modal
 * Description : This is a test suite for checking for a modal (a prompt)
 * when the response is a success
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
		showResponseModal({ response: true, message: msg }, false);

		// creating delay of 400ms
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
 * in case of a failure
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
		showResponseModal({ response: false, message: msg }, false);

		// creating delay of 400ms
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
 * Suite : Tests for undefined response
 * Description : This is a test suite for a undefined response
 * in case of a failure
 */
describe("Tests for undefined response", function() {
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

		showResponseModal();
		jasmine.clock().tick(4000);
	});

	afterEach(function() {
		jasmine.clock().uninstall();
	});

	it("should be visible", function() {
		expect($('.ui.modal')).toBeHidden();
	});
});

/**
 * Suite : Tests to place circle of trust icons in circle
 * Description : This is a test suite for checking if all the icons in the circle of trust are placed in a circle
 */
describe("Tests to place circle of trust icons in circle", function() {
	beforeEach(function() {
		jasmine.clock().install();
		setFixtures('<div class="circle"> \
				<ul> \
					<li>first</li> \
					<li>second</li> \
					<li>third</li> \
					<li>fourth</li> \
					<li>fifth</li> \
					<li>sixth</li> \
					<li>seventh</li> \
				</ul> \
			</div>');
		placeCircleOfTrustIcons();
		// creating delay of 400ms
		jasmine.clock().tick(4000);
	});

	it("should transform elements", function() {
		expect($('.circle li')[1].style.webkitTransform).toBe('rotate(-90deg) translate(200%) rotate(90deg)');
		expect($('.circle li')[2].style.webkitTransform).toBe('rotate(-30deg) translate(200%) rotate(30deg)');
		expect($('.circle li')[3].style.webkitTransform).toBe('rotate(30deg) translate(200%) rotate(-30deg)');
		expect($('.circle li')[4].style.webkitTransform).toBe('rotate(90deg) translate(200%) rotate(-90deg)');
		expect($('.circle li')[5].style.webkitTransform).toBe('rotate(150deg) translate(200%) rotate(-150deg)');
		expect($('.circle li')[6].style.webkitTransform).toBe('rotate(210deg) translate(200%) rotate(-210deg)');
	});

	afterEach(function() {
		jasmine.clock().uninstall();
	});
});

/**
 * Suite : Tests to show circle of trust icons
 * Description : This is a validating if all the icons of circle of trust are placed in a circle
 */
describe("Tests to show circle of trust icons", function() {
	var msg = 'This is a test message for showing error';
	beforeEach(function() {
		jasmine.clock().install();
		setFixtures('<div class="circle-of-trust-page"> \
				<div class="circle-of-trust"></div> \
				<div class="edit-comrades-section"></div> \
				<div class="comrade-action-section"></div> \
			</div>');
		spyOn($.fn, "fadeOut").and.callFake(function() {
			$(this).hide();
		});
		spyOn($.fn, "fadeIn").and.callFake(function() {
			$(this).show();
		});
        toggleCircleOfTrustSections('back');
		jasmine.clock().tick(4000);
	});

	it("back button clicked", function() {
		expect($('.circle-of-trust-page .edit-comrades-section')).toBeHidden();
		expect($('.circle-of-trust-page .comrade-action-section')).toBeHidden();
		expect($('.circle-of-trust-page .circle-of-trust')).toBeVisible();
	});

	afterEach(function() {
		jasmine.clock().uninstall();
	});
});

/**
 * Suite : Tests for showing error on incorrect field entry
 * Description : This is a test suite for showing error in case of an invalid field entry
 */
describe("Tests to show edit circle of trust section", function() {
	var msg = 'This is a test message for showing error';
	beforeEach(function() {
		jasmine.clock().install();
		setFixtures('<div class="circle-of-trust-page"> \
				<div class="circle-of-trust"></div> \
				<div class="edit-comrades-section"></div> \
				<div class="comrade-action-section"></div> \
			</div>');
		spyOn($.fn, "fadeOut").and.callFake(function() {
			$(this).hide();
		});
		spyOn($.fn, "fadeIn").and.callFake(function() {
			$(this).show();
		});
        toggleCircleOfTrustSections('edit');
		// creating delay of 400ms
		jasmine.clock().tick(4000);
	});

	it("edit button clicked", function() {
		expect($('.circle-of-trust-page .edit-comrades-section')).toBeVisible();
		expect($('.circle-of-trust-page .comrade-action-section')).toBeHidden();
		expect($('.circle-of-trust-page .circle-of-trust')).toBeHidden();
	});

	afterEach(function() {
		jasmine.clock().uninstall();
	});
});

/**
 * Suite : Tests for showing error on incorrect field entry
 * Description : This is a test suite for showing error in case of an invalid field entry
 */
describe("Tests to show get help section", function() {
	var msg = 'This is a test message for showing error';
	beforeEach(function() {
		jasmine.clock().install();
		setFixtures('<div class="circle-of-trust-page"> \
				<div class="circle-of-trust"></div> \
				<div class="edit-comrades-section"></div> \
				<div class="comrade-action-section"></div> \
			</div>');
		spyOn($.fn, "fadeOut").and.callFake(function() {
			$(this).hide();
		});
		spyOn($.fn, "fadeIn").and.callFake(function() {
			$(this).show();
		});
        toggleCircleOfTrustSections('help');
		// creating delay of 400ms
		jasmine.clock().tick(4000);
	});

	it("get help button clicked and update comrades detail section made visible", function() {
		expect($('.circle-of-trust-page .edit-comrades-section')).toBeHidden();
		expect($('.circle-of-trust-page .comrade-action-section')).toBeVisible();
		expect($('.circle-of-trust-page .circle-of-trust')).toBeHidden();
	});

	afterEach(function() {
		jasmine.clock().uninstall();
	});
});
