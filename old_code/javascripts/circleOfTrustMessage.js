  $(document).ready(function() {
  $('.popup-button').click(function() {
    var thisElement = this.id;
    var msgDataSet = {
      'msg1': "Come and get me.I need help getting home safely.Call ASAP to get my Location.Message sent through First Aide's Circle of Trust",
      'msg2': "Call and pretend you need me.I need an interruption.Message sent through First Aide's Circle of Trust",
      'msg3': "I need to talk.Message sent through First Aide's Circle of Trust"
    }

    if (msgDataSet[thisElement]) {
      $.ajax({
        url: 'groupsms.php',
        type: 'POST',
        data: {
          msg: msgDataSet[thisElement]
        },
        success: function(response) {
          if (response>=1) {
            salert('Success','Message has been sent to '+response+' comrades','success');
          } else if (response==0) {
            salert('Error','No comrades registered'+response,'error');
          } else {
            salert('Error','Service Unavailable.','error');
          }
          closePopup();
        }
      });
    }
  });
});