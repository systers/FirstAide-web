/*Created by Akanksha
  Desc: Gets phonenumber from twilio-sms.js and send it to twilioSMS.php
*/
function send_sms(phonenum){

    var redirect = function(url, method) {
    var form = document.createElement('form');
    form.method = method;
    form.action = url;
    var input = document.createElement('input');
    input.type = "text";
    input.name = "getnum";
    input.value = phonenum;
    document.body.appendChild(form);
    form.appendChild(input);
    form.submit();
   };
   redirect('twilioSMS.php', 'post');
}

