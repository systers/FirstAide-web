<?php
/*Created by Akanksha
  Desc: Front end for Circle of Trust*/
   
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
  <link rel="stylesheet" type="text/css" href="css files/circle-of-trust.css"/>
  <link rel="stylesheet" href="css files/sweetalert.css">
  <link rel="stylesheet" href="css files/loader.css">
</head>
<body>
<?php
     include('menu.php');
?>
<center>
<div class="window">
  <div>
    <h1 class="text">Circle of Trust</h1>
    <hr class="line">
    <h2 class="text">My Trustees</h2>
  </div>

  <div>
     <a href="editComrades.php">
       <img id="ic-edit" src="images/ic_edit_button.png" alt="" width="64" height="64">
     </a>
  </div>

  <!--The icons and help me aligned in a circle-->
  <div class="icons-container">
    <div class="icons-row">
      <img src="images/ic_comrade.png" id="comrade1" alt="" width="64" height="64">
      <img src="images/ic_comrade.png" id="comrade2" alt="" width="64" height="64">
    </div>
    <div class="icons-row">
      <img src="images/ic_comrade.png" id="comrade3" alt="" width="64" height="64">
      <img id="help_me" src="images/ic_help_me.png" onclick="openPopup()" alt="" width="100" height="100">
      <img src="images/ic_comrade.png" id="comrade4" alt="" width="64" height="64">
    </div>
    <div class="icons-row">
      <img src="images/ic_comrade.png" id="comrade5" alt="" width="64" height="64">
      <img src="images/ic_comrade.png" id="comrade6" alt="" width="64" height="64">
    </div>
  </div>

   <!-- Popup for Request, when Help me button is clicked -->
  <div id="popup-cnt" class="popup">
    <div class="popup-content">
      <span id="close-cnt" class="close"><img src="images/close-button.png" style="height: 15px;width: 15px;"></span>
      <h3 class="text">Select a Request</h3>
      <button id="msg1"   class="popup-button">Come Get me</button>
      <button id="msg2"  class="popup-button">Call I need an interruption</button>
      <button id="msg3"  class="popup-button">I need to talk</button>
    </div>
  </div>
  <div class="modal"></div>
  
</div>
</center>
  <script src="javascripts/popup.js"></script>
  <script src = "http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="javascripts/sweetalert.js"></script>
  <script src="javascripts/sweetalert.min.js"></script>
  <script src="javascripts/closePopup.js"></script>
  <script src="javascripts/circleOfTrustMessage.js"></script>
</body>
</html>