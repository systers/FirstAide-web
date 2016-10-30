<?php
/*Created by Akanksha
  Desc: Implementation of office of victim advocacy of 'Get Help now'
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
    <h1 class="text">Office of Victim Advocacy</h1>
    <hr class="line">
  </div>
  
  <!--opens popup to contact via SMS or Call-->
  <button class="small-button" id="bt-cntnw" name="bt-cntnw" onclick="openPopup()">Contact Now</button>

  <div class="block">
    <p>
     Victim Advocates are available for Volunteers who are victims of crimes. They can provide information regarding available response services, address questions/concerns, and ensure their voices are heard and considered in all decisions affecting service and care.
    </p>
    Email: <a href="mailto:victimadvocate@peacecorps.gov">victimadvocate@peacecorps.gov</a>
  </div>

    <!-- Popup for contact Now -->
  <div id="popup-cnt" class="popup">
    <div class="popup-content">
      <span id="close-cnt" class="close"><img src="images/close-button.png" style="height: 15px;width: 15px;"></span>
      <h3 class="text">Contact Office of Victim advocacy via</h3>
      <button style="text-indent:center; padding-right:3cm;" id="call" class="popup-button" onclick="make_call('2024092701')"><i style="float:left; padding-left:3cm" class="w3-margin-left fa fa-phone fa-lg"></i>Voice Call</button>
      <button style="text-indent:center; padding-right:3cm;" id="msg" class="popup-button" onclick="send_sms('2024092701')"><i style="float:left; padding-left:3cm" class="w3-margin-left fa fa-envelope fa-lg"></i>Send Message</button>
    </div>
  </div>

</div><!--closing div for window-->   
</center>
  <script type="text/javascript" src="javascripts/popup.js"></script>
  <script type="text/javascript" src="javascripts/twilio-sms.js"></script>
  <script type="text/javascript" src="javascripts/twilio-call.js"></script>
</body>
</html>