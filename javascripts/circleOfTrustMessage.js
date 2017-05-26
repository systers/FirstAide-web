$(document).ready(function() {
  
            $("#msg1").click(function(event){
               $body = $("body");
               $.ajaxSetup({'global':true});
               $(document).ajaxStart(function(){
                 $body.addClass("loading");
               });
               $.post( 
                  "groupsms.php",
                  { msg: "Come and get me.I need help getting home safely.Call ASAP to get my Location.Message sent through First Aide's Circle of Trust" },
                  function(data) {
                      $.ajaxSetup({'global':true});
                      $(document).ajaxStop(function(){
                        $body.removeClass("loading");
                      });
                      if (data>=1) 
                       salert('Success','Message has been sent to '+data+' comrades','success');
                      else if(data==0)
                        salert('Error','No comrades registered'+data,'error');
                      else
                        salert('Error','Service Unavailable.','error');
                    closePopup(); 
                    
                  }
               );
          
            });

              $("#msg2").click(function(event){
               $body = $("body");
               $.ajaxSetup({'global':true});
               $(document).ajaxStart(function(){
                 $body.addClass("loading");
               });
               $.post( 
                  "groupsms.php",
                  { msg: "Call and pretend you need me.I need an interruption.Message sent through First Aide's Circle of Trust" },
                  function(data) {
                      $body = $("body");
                      $.ajaxSetup({'global':true});
                      $(document).ajaxStop(function(){
                        $body.removeClass("loading");
                      });
                      if (data>=1) 
                       salert('Success','Message has been sent to '+data+' comrades','success');
                      else if(data==0)
                        salert('Error','No comrades registered'+data,'error');
                      else
                        salert('Error','Service Unavailable','error'); 
                    closePopup();
                  }
               );
          
            });

              $("#msg3").click(function(event){
               $body = $("body");
               $.ajaxSetup({'global':true});
               $(document).ajaxStart(function(){
                 $body.addClass("loading");
               });
               $.post( 
                  "groupsms.php",
                  { msg: "I need to talk.Message sent through First Aide's Circle of Trust" },
                  function(data) {
                      $body = $("body");
                      $.ajaxSetup({'global':true});
                      $(document).ajaxStop(function(){
                        $body.removeClass("loading");
                      });
                      if (data>=1) 
                       salert('Success','Message has been sent to '+data+' comrades','success');
                      else if(data==0)
                        salert('Error','No comrades registered'+data,'error');
                      else
                        salert('Error','Service Unavailable','error');
                    closePopup();
                  }
               );
          
            });
        
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

