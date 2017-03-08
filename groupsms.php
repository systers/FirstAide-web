<?php
/*Created by Akanksha
  Desc: Used to send bulk sms using Twilio API. Use in Circle of Trust
*/   
    require "Services/Twilio.php";
    include 'loadComradeNumbers.php';
    $toNos = array();//comrade numbers will be added here

    foreach ($dbphnos as $num)//$dbphnos come from loadComradeNumbers.php
    {
      if($num!=NULL)
      {
         array_push($toNos,$num);
      }
    }

    foreach ($toNos as &$value) {
    $value = '+'.$value; //Add + to make it a valid number
   }
   unset($value);
    if(isset($_REQUEST["msg"])){
      if( $_REQUEST["msg"] ){ //getting the body of the msg from twilio-sms.js

      $msg = $_REQUEST['msg'];
      }
    }
    else{
      header("location:circleOfTrust.php");
    }
    //set AccountSid and AuthToken from www.twilio.com/user/account
    $AccountSid = "";
    $AuthToken = "";

    // avoid tinyhttp exception
    $http = new Services_Twilio_TinyHttp('https://api.twilio.com', array('curlopts' => array(
    CURLOPT_SSL_VERIFYPEER => false
    )));

    //instantiate a new Twilio Rest Client
    $client = new Services_Twilio($AccountSid, $AuthToken, '2010-04-01', $http);

    //Loop over all comrades. $number is a phone number above, and 
    // $name is the name next to it
    try {
        $sent = 0;
        foreach ($toNos as $number) {
           
         $sms = $client->account->messages->sendMessage(
         // Change the 'From' number below to be a valid Twilio number 
         // that you've purchased, or the (deprecated) Sandbox number
            "", 
            // the number we are sending to - Any phone number
            $number,
            // the sms body
            $msg
         );
         
        $sent = $sent + 1;
      }
      echo $sent;//count of messages successfull is sent to circleOfTrustMessage.js 
    }
    catch(\Services_Twilio_RestException $e){
        $error = $e->getMessage();
        echo $error;
    }
    
    /*do not close php using ?> here*/
        
    