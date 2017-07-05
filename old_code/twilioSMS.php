<!--Created by Akanksha
    Desc: Twilio API to send SMS and form to enter message
-->
<?php
  require_once('includes/settings.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>FirstAide</title>
  <link rel="stylesheet" type="text/css" href="css files/gethelpnow-style.css"/>
  <link rel="stylesheet" href="css files/sweetalert.css">  
  <link rel="stylesheet" href="css files/loader.css">
</head>
<body>
<?php

  if(!isset($_SESSION))
    session_start();
  if(!isset($_SESSION['email']))
  {   
     header("location:login.php");
  }
   
  include('menu.php'); 
  
  if(isset($_POST['getnum']))
    $number = $_POST['getnum'];//get number from twilio-sms.js
  else if(isset($_POST['number'])) 
    $number = $_POST['number'];//get number from the form input 'number'
  else
    header("location:getHelpNow.php")
?>
<center>
<div class="window">
  <form method="POST">
  <div>
    <h1 class="text">Send Message</h1>
    <hr class="line">
    <input id="input" name="number" value="<?php echo $number;?>" readonly>
  </div>
  <!--input for body of message-->
  <div> 
    <textarea id="SMS-body" name="SMS-body" placeholder="Type your message here" required></textarea>
  </div>

  <div>
  <input type="submit" value="Send SMS" class="small-button" id="bt-SMS" name="bt-SMS">
  </div>
  <div class="modal"></div>
</form>
</div>     
</center>
  <script src="javascripts/sweetalert.min.js"></script>
  <script src="javascripts/sweetalert.js"></script>
  <script src="javascripts/twilio-sms.js"></script>
  <script src="javascripts/sms-loader.js"></script>
</body>
</html>
<?php
   
if(isset($_POST['SMS-body'])&&!empty($_POST['SMS-body']))
{

  // ==== Control Vars =======
  $strToNumber = "+".$number;//get number from the twilio-sms.js file
  $strMsg = $_POST['SMS-body']; 

  $aryResponse = array();
 
   //include the Twilio PHP library 
   require_once ("Services/Twilio.php");
 
    // avoid tinyhttp exception
    $http = new Services_Twilio_TinyHttp('https://api.twilio.com', array('curlopts' => array(
    CURLOPT_SSL_VERIFYPEER => false
    )));

    $objConnection = new Services_Twilio($_settings['twilio']['account_sid'], $_settings['twilio']['auth_token'], '2010-04-01', $http);

    // Send a new outgoinging SMS by POSTing to the SMS resource */
    try {
        $bSuccess = $objConnection->account->sms_messages->create(
          $_settings['twilio']['number'],
          $strToNumber,
          $strMsg // the sms body
        );

       echo "<script type='text/javascript'>salert('Success!','SMS Sent Successfully','success');</script>";
    }
    catch(\Services_Twilio_RestException $e){
      $error = $e->getMessage();
      echo "<script type='text/javascript'>salert('SMS not sent','Possible Reason : Invalid phone number (It must be of the form countrycode followed by valid number Eg:15417543010)'
      ,'error');</script>";
    }

  }
  /*do not close php using ?> here*/

