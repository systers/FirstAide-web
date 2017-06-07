/*Created by Akanksha
  Desc: Gets phonenumber from twilio-call.js and sends it to twilioCall.php
*/
function make_call(phonenum)
{
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
   redirect('twilioCall.php', 'post');
}
