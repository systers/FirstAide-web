var error, pass, score = 0;
 var password = document.getElementById('password');
var meter = document.getElementById('password-strength-meter');
 var text = document.getElementById('password-strength-text');
 var suggestion = document.getElementById('suggestion');

 password.addEventListener('input', function () {
     score = 0;
 error = [];
     pass = password.value;

     // 1 point for adding uppercase letter in password
     if (/[A-Z]/.test(pass))
         score++;
  else
         error.push("at least one upper case letters");

     // 1 point for adding number letter in password
     if (/[0-9]/.test(pass))
         score++;
  else
        error.push("at least one number");
    // 1 point for adding special character letter in password
     if (!(/^[a-zA-Z0-9- ]*$/.test(pass)))
        score++;
   else
         error.push("at least one special character");

     // length of password should be atleast 6
     if (pass.length < 6) {
         score = 0;
         error.push("minimum 6 characters long");
             }
   else {
         score++;
     }

     // display suggestions to improve password strength
     var html = ""
     for (var i = 0; i < error.length; i++) {
         html += "<li>" + error[i] + "</li>"
     }
     suggestion.innerHTML = html;

     // updates the password meter value and text
     meter.value = score;
     if (score == 4) {
         text.innerText = "Password Strength: Very Strong"
     }
        else if (score == 3) {
         text.innerText = "Password Strength: Strong";
   }
    else if (score == 2) {
         text.innerText = "Password Strength: Weak";
     }
     else {
         text.innerText = "Password Strength: Very Weak";
     }
 });
