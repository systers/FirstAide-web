/* DOCUMENT INFORMATION
 - Created by : Akanksha
 - Description : Validation for Registration
 */

function validate() {
    // keeps count of invalid fields
    var invalid = 0;

    var email = document.getElementById('email');
    var uname = document.getElementById('uname');
    var pwd = document.getElementById('password');
    var country = document.getElementById('host_country');

    // regular expressions for validation in registration page
    var regexname = /^[a-zA-Z ]+\d*$/;
    var regexcountry = /^[a-zA-Z]{2,}$/;
    var regexemail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;

    // validate name
    if (!regexname.test(uname.value))
    {
        invalid++;
        document.getElementById('uname').style.borderColor = "red";
    }
    else
        document.getElementById('uname').style.borderColor = "white";

    // validate country
    if (!regexcountry.test(country.value))
    {
        invalid++;
        document.getElementById('host_country').style.borderColor = "red";
    }
    else
        document.getElementById('host_country').style.borderColor = "white";

    // validate email id
    if (!regexemail.test(email.value))
    {
        invalid++;
        document.getElementById('email').style.borderColor = "red";
    }
    else
        document.getElementById('email').style.borderColor = "white";

    // validate password
    if (score < 3) {
        invalid++;
        document.getElementById('password').style.borderColor = "red";
        document.getElementById('password').focus();
    }
    else
        document.getElementById('password').style.borderColor = "white";

    return invalid <= 0;
}