/*Created by Akanksha
  Desc: Sends correct number to twilio-call or twilio-sms
  based on the location and organization selected
 */
function setnum(id)
{
	var phonenum = "0";
	var location = document.getElementById("location").value;
	/*set var phonenum to the correct value depending on which button PCMO or SSM or SARL 
     invoked this function*/
	switch(id)
	{
		//set the correct phone numbers here (after given from Peace Corps), these are sample
		case "PCMO-msg" :
		case "PCMO-call":
		{
          if(location=="Syria")        //set var phonenum according to location selected
		    phonenum = "4444";
	      else if(location =="Uganda")
		    phonenum = "1111";
	      else if(location == "Tunisia")
		    phonenum = "7777";
		  break;	
		}
		case "SSM-msg" :
		case "SSM-call":
		{
	      if(location=="Syria")
		    phonenum = "5555";
	      else if(location =="Uganda")
		    phonenum = "2222";
	      else if(location == "Tunisia")
		    phonenum = "8888";
		  break;
		}
		case "SARL-msg" :
		case "SARL-call":
		{
	      if(location=="Syria")
		    phonenum = "6666";
	      else if(location =="Uganda")
		    phonenum = "3333";
	      else if(location == "Tunisia")
		    phonenum = "9999";
		  break;
		}

	}
	if(id.indexOf("msg")>-1)//check if id contains "msg" string
	  send_sms(phonenum); //send phone number to twilio-sms.js
	else 
	  make_call(phonenum);//send phone number to twilio-call.js
}  