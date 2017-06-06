const validation = {
    isEmailAddress:function(str) {
        const pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return pattern.test(str);
    }
}
function showError(ele, msg) {
	ele.addClass('error');
	ele.find('.ui.red.pointing').text(msg);
	ele.find('.ui.red.pointing').show();
	setTimeout(function() {ele.find('.ui.red').hide();}, 7000);
}
function hideError(ele) {
	ele.removeClass('error');
	ele.find('.ui.red.pointing').hide();
}
function notEmpty(ele) {
	if (ele.ele.val().trim().length <= 0) {
		showError(ele.ele.parent(), ele.text);
		return false;
	} else {
		hideError(ele.ele.parent());
		return true;
	}
}
function showResponse(thisElement, response) {
	if (!response.response) {
		$('.ui.modal').find('.content').text(response.message);
		$('.ui.modal').modal('show');
	} else {
		setTimeout(function() {
			thisElement.fadeOut('slow', function() {
				$('.processing').fadeIn('slow');
			});
		}, 100);

		var val = 15;
		for(count = 0; count < 4; count++) {
			var val = Math.floor((Math.random() * (15 + ((count + 1) * 12)) + val));
			setTimeout(function() {
				$('.processing .progress').progress({percent: val});
			}, 500);
		}
		setTimeout(function() {
			$('.ui.modal').find('.content').text(response.message);
			$('.ui.modal').modal('show');
		}, 4000);
		setTimeout(function() {
			window.location.href = response.redirect_url;
		}, 5500);
	}
}

$(function() {
	$('.ui.dropdown').dropdown();
	$('#example1').progress();
});
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
$('.signup-form').find('#password').keyup(function(ele) {
	var scoreData = passwordScore($(this).val()),
		element = $('#password-strength-status');
	element.parent().show();
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
			break;
	}
});

$(document).ready(function() {
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
		validData = notEmpty({ ele: passwordElement, text: 'Please enter your password'});

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
			country = countryElement.val().trim();

		var validData = true;
		if (!validation.isEmailAddress(email)) {
			showError(emailElement.parent(), 'Please enter a valid email');
			validData = false;
		} else {
			hideError(emailElement.parent());
		}
		var elements = {
			name: {
				ele: nameElement,
				text: 'Please enter your name'
			},
			password: {
				ele: passwordElement,
				text: 'Please enter your password'
			},
			confirmPassword: {
				ele: confirmPasswordElement,
				text: 'Please retype your password'
			},
			country: {
				ele: countryElement,
				text: 'Please select your country'
			}
		}
		for (var k in elements) {
			validData = validData ? notEmpty(elements[k]) : validData;
		}
		if (password !== confirm_password) {
			confirmPasswordElement.val('');
			notEmpty({ele: confirmPasswordElement, text: 'Password did not match'});
			validData = false;
		}
		if (validData) {
			var postData = {
				type: 'signup',
				email: email,
				name: name,
				password: password,
				confirm_password: confirm_password,
				country: country,
				csrf_token: CSRF_TOKEN
			}
			console.log(postData);
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
