<?php
/*Created by Akanksha
  Desc: Implementation of PC Saves anonymous helpline of 'Get Help Now'
*/   
   if(!isset($_SESSION))
     session_start();
   if(!isset($_SESSION['email']))
   {  
      header("location: login.php"); 
   }
   
?>
<!DOCTYPE html>
<html>
<head>
  <title>FirstAide</title>
  <link rel="stylesheet" type="text/css" href="css files/gethelpnow-style.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
</head>
<body>
<?php
     include('menu.php');
?>
<center>
<div class="window">
  <div>
    <h1 class="text">PC Saves Anonymous Helpline</h1>
    <hr class="line">
  </div>

  <!--opens popup to contact via SMS or Call-->
  <button class="small-button" id="bt-cntPC" name="bt-cntPC" onclick="openPopup()">Contact Now</button>
  
  <div class="block">
    <p>
      The PC SAVES Helpline provides anonymous, confidential crisis intervention, support, and information via a call, text, or online chat to Peace Corps Volunteers and Trainees. All options are staffed by trained professionals not affiliated with Peace Corps, available 24/7.  No personally identifying information will be collected.
    </p>
    Learn More: <a href="https://pcsaveshelpline.org/" target=_blank>pcsaveshelpine.org</a>
  </div>

  <!-- Popup for contact Now -->
  <div id="popup-cnt" class="popup">
    <div class="popup-content">
      <span id="close-cnt" class="close"><img src="images/close-button.png" style="height: 15px;width: 15px;"></span>
      <h3 class="text">Contact PC Saves Anonymous Helpline via</h3>
      <button style="text-indent:center; padding-right:3cm;" id="call" class="popup-button" onclick="make_call('+14088444357')"><i style="float:left; padding-left:3cm" class="w3-margin-left fa fa-phone fa-lg"></i>Voice Call</button>
      <button style="text-indent:center; padding-right:3cm;" id="msg" class="popup-button" onclick="send_sms('+14088444357')"><i style="float:left; padding-left:3cm" class="w3-margin-left fa fa-envelope fa-lg"></i>Send Message</button>
    </div>
  </div>

</div><!--closing div of window-->  
</center>
  <script type="text/javascript" src="javascripts/popup.js"></script>
  <script type="text/javascript" src="javascripts/twilio-sms.js"></script>
  <script type="text/javascript" src="javascripts/twilio-call.js"></script>
</body>
</html>