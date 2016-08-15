<?php
/*Created by Akanksha
  Desc: Implementation of Office of civil rights and diversity of 'Get help now'
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
</head>
<body>
<?php
     include('menu.php');
?>
<center>
<div class="window">
    <div>
      <h1 class="text">Office of Civil Rights and Diversity</h1>
      <hr class="line">
    </div>

  <!--opens popup to contact using SMS or call-->
  <button class="small-button" id="bt-cntnw" name="bt-cntnw" onclick="openPopup()">Contact Now</button>
  
  <!--Some info-->
  <div class="block">
    <p>
     Resource to provide leadership and guidance on all civil rights, equal employment opportunity and diversity matters; and to address issues of discrimination and harassment, including sexual harassment, in the recruitment/service of Volunteers/Trainees.
    </p>
    Email: <a href="mailto:ocrd@peacecorps.gov">ocrd@peacecorps.gov</a>
  </div>

   <!-- Popup for contact Now -->
  <div id="popup-cnt" class="popup">
    <div class="popup-content">
      <span id="close-cnt" class="close"><img src="images/close-button.png" style="height: 15px;width: 15px;"></span>
      <h3 class="text">Contact Office of Civil Rights and Diversity via</h3>
      <button id="call" class="popup-button" onclick="make_call('2026922915')">Voice Call</button><!--calls twilio-call.js-->
      <button id="msg" class="popup-button" onclick="send_sms('2026922139')">Send Message</button><!--calls twilio-sms.js-->
    </div> 
  </div>
  
</div><!--closing div for window-->
</center>
  <script type="text/javascript" src="javascripts/popup.js"></script>
  <script type="text/javascript" src="javascripts/twilio-call.js"></script>
  <script type="text/javascript" src="javascripts/twilio-sms.js"></script>
</body>
</html>