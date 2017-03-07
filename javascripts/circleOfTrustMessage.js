$(document).ready(function() {
  
            $("#msg1").click(function(event){
               $.post( 
                  "groupsms.php",
                  { msg: "Come and get me.I need help getting home safely.Call ASAP to get my Location.Message sent through First Aide's Circle of Trust" },
                  function(data) {
                    
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
               $.post( 
                  "groupsms.php",
                  { msg: "Call and pretend you need me.I need an interruption.Message sent through First Aide's Circle of Trust" },
                  function(data) {
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
               $.post( 
                  "groupsms.php",
                  { msg: "I need to talk.Message sent through First Aide's Circle of Trust" },
                  function(data) {
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
        
         });