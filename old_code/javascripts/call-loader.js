var $body = $("body");
$.ajaxSetup({'global':true});
$(document).ajaxStart(function(){
  $body.addClass("loading");
});
$("#submit").click(function(event){
  $.ajax("twilioCall.php")
}); 