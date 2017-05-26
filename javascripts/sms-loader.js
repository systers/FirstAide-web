var $body = $("body");
$.ajaxSetup({'global':true});
$(document).ajaxStart(function(){
  $body.addClass("loading");
});
$("#bt-SMS").click(function(event){
  $.ajax("twilioSMS.php")
}); 