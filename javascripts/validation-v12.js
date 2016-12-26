/*Created by Akanksha
  Desc: Validation for Registration
*/
function validate()
{
  var invalid = 0;//keeps count of invalid fields

	var email = document.getElementById('email');
	var uname = document.getElementById('uname');
	var pwd = document.getElementById('password');
	var country = document.getElementById('host_country');
  //regular expressions for validation in registration page
	var regexname = /^[a-zA-Z ]+\d*$/;
	var regexcountry = /^[a-zA-Z]{2,}$/;
	var regexemail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;


    if (!regexname.test(uname.value)) //validate name
     {
        invalid++;
        document.getElementById('uname').style.borderColor = "red";
     }
    else
       document.getElementById('uname').style.borderColor = "white";

    if (!regexcountry.test(country.value))//validate country
    {
    	invalid++;
    	document.getElementById('host_country').style.borderColor = "red";
    }
    else
      document.getElementById('host_country').style.borderColor = "white";

    if (!regexemail.test(email.value))//validate email id
    {
    	invalid++;
    	document.getElementById('email').style.borderColor = "red";
    }
    else
      document.getElementById('email').style.borderColor = "white";

    if(invalid>0)
    	return false;
      if (score < 3) {
         invalid++;
          document.getElementById('password').style.borderColor = "red";
          document.getElementById('password').focus();
      }
       else
     	return true;
          document.getElementById('password').style.borderColor = "white";

      return invalid <= 0;
   }
