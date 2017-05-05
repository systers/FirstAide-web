<!-- Created by Akanksha
     Desc: Twilio Call API used to make voive call
-->
<?php
  require_once('includes/settings.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>FirstAide</title>
  <link rel="stylesheet" type="text/css" href="css files/gethelpnow-style.css"/>
  <link rel="stylesheet" href="css files/sweetalert.css"/>
  <form method="POST"/>
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
  <div>
    <h1 class="text">Make Call</h1>
    <hr class="line">
    <input id="input" name="number" value="<?php echo $number; ?>" readonly>
  </div>

  <div>
      <input class="small-button" value="Call" type="submit" id="submit" name="submit">
  </div>

</div>     
</center>
  <script src="javascripts/sweetalert.min.js"></script>
  <script src="javascripts/sweetalert.js"></script>
  <script src="javascripts/twilio-call.js"></script>
</body>
</html>
<?php
    
    
    // Include the Twilio PHP library for making a call
  if(isset($_POST['number']))
  {
    require_once ("Services/Twilio.php");

    // Twilio REST API version
    $version = "2010-04-01";
    $tophonenumber = $number;

     $http = new Services_Twilio_TinyHttp('https://api.twilio.com', array('curlopts' => array(
    CURLOPT_SSL_VERIFYPEER => false
    )));

    // Instantiate a new Twilio Rest Client
    $client = new Services_Twilio($_settings['twilio']['account_sid'], $_settings['twilio']['auth_token'], $version, $http);

    try {
        // Initiate a new outbound call
        $call = $client->account->calls->create(
            $_settings['twilio']['number'], // The number of the phone initiating the call
            $tophonenumber, // The number of the phone receiving call
            'http://demo.twilio.com/welcome/voice/' // The URL Twilio will request when the call is answered
        );
        echo "<script type='text/javascript'>salert('Success','Call started','success');</script>";
    } 
    catch (\Services_Twilio_RestException $e) {
        
        $error = $e->getMessage();
        echo "<script type='text/javascript'>salert('Error','Service Unavailable','error');</script>";
    }
  }
