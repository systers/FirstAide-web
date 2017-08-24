/**
 * notEmpty() checks if the given input field is empty
 *
 * @elementData {dictionary} contains field element to check
 * an error message to show
 */
function notEmpty(elementData) {
	if (typeof elementData.element !== 'undefined') {
		if (elementData.element.val().trim().length <= 0) {
			showError(elementData.element.parent(), elementData.text);
			return false;
		} else {
			hideError(elementData.element.parent());
			return true;
		}
	}
	return false;
}

/**
 * showResponse() displays modal on receiving response
 *
 * @thisElement {DOM element} The element to fadeOut
 * on receiving successfull  response
 * @response {dictionary} contains ajax call response
 */
function showResponse(thisElement, response) {
	if (!response.response) {
		$('.ui.modal').find('.header').text('Are you lost?');
		$('.ui.modal').find('.content').text(response.message);
		$('.ui.modal').modal('show');
	} else {
		setTimeout(function() {
			thisElement.fadeOut('slow', function() {
				$('.processing').fadeIn('slow');
			});
		}, 100);

		var val = 85;
		$('.processing .progress').progress({percent: val});
		setTimeout(function() {
			$('.ui.modal').find('.header').text('Yippee');
			$('.ui.modal').find('.content').text(response.message);
			$('.ui.modal').modal('show');
		}, 2000);

		if (response.redirect_url) {
			setTimeout(function() {
				window.location.href = response.redirect_url;
			}, 5500);
		} else if(typeof response.reload !== 'undefined' && response.reload) {
			setTimeout(function() {
				location.reload();
			}, 4000);
		}
	}
}

/**
 * passwordScore() calculates the password score
 *
 * @pass {string} The password string
 */
function passwordScore(pass) {
	var score = 1,
		error = [];

	if (/[A-Z]/.test(pass)) {
        score++;
	} else {
        error.push("at least one upper case letters");
	}

    if (/[0-9]/.test(pass)) {
        score++;
    } else {
        error.push("at least one number");
    }

    if (!(/^[a-zA-Z0-9- ]*$/.test(pass))) {
        score++;
    } else {
        error.push("at least one special character");
    }

    if (pass.length < 6) {
        score = 0;
        error.push("minimum 6 characters long");
    }
    else {
        score++;
    }
    return {score: score, error: error};
}

/**
 * passwordFieldKeyUp() displays error messages for password field
 * on keyUp event
 *
 * @passwordField {DOM element} The password input field
 */
function passwordFieldKeyUp(passwordField) {
	if (typeof passwordField !== 'undefined') {
		var scoreData = passwordScore(passwordField.val()),
			element = $('#password-strength-status');
		element.parent().show();
		hideError(passwordField.parent());
		switch(scoreData.score) {
			case 7:
			case 6:
			case 5:
			case 4:
				element.progress({percent: 95});
				element.removeClass().addClass('ui green progress');
				element.find('.label').html("Password Strength: Very Strong");
				break;
			case 3:
				element.progress({percent: 75});
				element.removeClass().addClass('ui orange progress');
				element.find('.label').html("Password Strength: Strong");
				break;
			case 2:
				element.progress({percent: 45});
				element.removeClass().addClass('ui yellow progress');
				element.find('.label').html("Password Strength: Weak");
				break;
			default:
				element.progress({percent: 25});
				element.removeClass().addClass('ui red progress');
				element.find('.label').html("Password Strength: Very Weak");
				showError(passwordField.parent(), 'Minimum 6 characters long');
				break;
		}
	}
}

$('.signup-form').find('#password').keyup(function() {
	passwordFieldKeyUp($(this));
});

$(document).ready(function() {
	$(function() {
		$('.ui.dropdown').dropdown();
		$('#example1').progress();
		if (typeof window.USERS_COUNTRY !== 'undefined') {
			$('.item[data-value~="' + window.USERS_COUNTRY +'"]').trigger( "click" );
		}
	});
	setTimeout(function() {
		$('.preloader').fadeOut('slow', function() {
			$('.content').fadeIn('slow');
		});
	}, 1000);
	$( "#sign-up-link" ).click(function(e) {
		e.preventDefault();
		$('.login-form-main').fadeOut('slow', function() {
			$('.signup-form-main').fadeIn('slow');
		});
	});
	$( "#login-link" ).click(function(e) {
		e.preventDefault();
		$('.signup-form-main').fadeOut('slow', function() {
			$('.login-form-main').fadeIn('slow');
		});
	});

	$( ".login-form .submit" ).click(function(e) {
		e.preventDefault();
		var thisElement = $('.login-form'),
			emailElement = thisElement.find('#email'),
			passwordElement = thisElement.find('#password'),
			email = emailElement.val().trim(),
			password = passwordElement.val().trim();

		var validData = true;
		if (!validation.isEmailAddress(email)) {
			showError(emailElement.parent(), 'Please enter a valid email');
			validData = false;
		} else {
			hideError(emailElement.parent());
		}
		validData = notEmpty({ element: passwordElement, text: 'Please enter your password'});

		if (validData) {
			var postData = {
				type: 'login',
				email: email,
				password: password,
				csrf_token: CSRF_TOKEN
			}
			try {                                                                                                               
				$.ajax({
					url: 'request/auth.php',
					type: "POST", 
					dataType: 'json',
					data: postData,
					success: function(response) {
						showResponse(thisElement, response);
					}
				});
			} catch (error) {
				return false;
			}
		}
	});
	$( ".signup-form .submit" ).click(function(e) {
		e.preventDefault();
		var thisElement = $('.signup-form'),
			emailElement = thisElement.find('#email'),
			nameElement = thisElement.find('#name'),
			passwordElement = thisElement.find('#password'),
			confirmPasswordElement = thisElement.find('#confirm_password'),
			countryElement = thisElement.find('#country'),
			email = emailElement.val().trim(),
			name = nameElement.val().trim(),
			password = passwordElement.val().trim(),
			confirm_password = confirmPasswordElement.val().trim(),
			country = countryElement.val().trim(),
			type = 'signup';

		var validData = true;
		if (!validation.isEmailAddress(email)) {
			showError(emailElement.parent(), 'Please enter a valid email');
			validData = false;
		} else {
			hideError(emailElement.parent());
		}
		if (password.length < 6) {
			showError(passwordElement.parent(), 'Minimum 6 characters long');
			validData = false;
		} else {
			hideError(passwordElement.parent());
		}
		var elements = {
			name: {
				element: nameElement,
				text: 'Please enter your name'
			},
			password: {
				element: passwordElement,
				text: 'Please enter your password'
			},
			confirmPassword: {
				element: confirmPasswordElement,
				text: 'Please retype your password'
			},
			country: {
				element: countryElement,
				text: 'Please select your country'
			}
		}
		for (var key in elements) {
			validData = validData ? notEmpty(elements[key]) : validData;
		}
		if (password !== confirm_password) {
			confirmPasswordElement.val('');
			notEmpty({element: confirmPasswordElement, text: 'Password did not match'});
			validData = false;
		}
		if ($('#request_type').length && $('#request_type').val() == 'update_user_info') {
			type = 'update';
		}
		if (validData) {
			var postData = {
				type: type,
				email: email,
				name: name,
				password: password,
				confirm_password: confirm_password,
				country: country,
				csrf_token: CSRF_TOKEN
			}
			try {                                                                                                               
				$.ajax({
					url: 'request/auth.php',
					type: "POST", 
					dataType: 'json',
					data: postData,
					success: function(response) {
						showResponse(thisElement, response);
					}
				});
			} catch (error) {
				return false;
			}
		}
	});
});
