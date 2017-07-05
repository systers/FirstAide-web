<?php
/*Created by Akanksha
  Desc: Implementation of office of inspector general of 'Get Help now'
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
    <h1 class="text">Office of Inspector General</h1>
    <hr class="line">
  </div>
  
  <!--opens popup to contact via SMS or Call-->
  <button class="small-button" id="bt-cntnw" name="bt-cntnw" onclick="openPopup()">Contact Now</button>

  <div class="block">
    <p>
     OIG is a resource for those who have been harmed by misconduct or criminal wrongdoing by a fellow Volunteer or Peace Corps Staff.  They are independent from Peace Corps with law enforcement officers who have the unique authorities to help seek a fair resolution and, in appropriate cases, to seek prosecution in the United States or host country.  
    </p>
    Learn more: <a href="http://www.peacecorps.gov/about/inspgen/" target="_blank">peacecorps.gov/OIG</a>
  </div>

   <!-- Popup for contact Now -->
  <div id="popup-cnt" class="popup">
    <div class="popup-content">
      <span id="close-cnt" class="close"><img src="images/close-button.png" style="height: 15px;width: 15px;"></span>
      <h3 class="text">Contact Office of Inspector General via</h3>
      <button style="text-indent:center; padding-right:3cm;" id="call" class="popup-button" onclick="make_call('2026922915')"><i style="float:left; padding-left:3cm" class="w3-margin-left fa fa-phone fa-lg"></i>Voice Call</button>
      <button style="text-indent:center; padding-right:3cm;" id="msg" class="popup-button" onclick="send_sms('2026922915')"><i style="float:left; padding-left:3cm" class="w3-margin-left fa fa-envelope fa-lg"></i>Send Message</button>
    </div>
  </div>

</div><!--closing div of window-->   
</center>
  <script type="text/javascript" src="javascripts/popup.js"></script>
  <script type="text/javascript" src="javascripts/twilio-sms.js"></script>
  <script type="text/javascript" src="javascripts/twilio-call.js"></script>
</body>
</html>