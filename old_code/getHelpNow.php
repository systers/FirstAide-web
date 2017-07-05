<?php
/*Created by Akanksha
  Desc: Form for Contact PCMO, Contact SSM and Contact SARL of 'Get Help now'
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
    <h1 class="text">Get Help Now</h1>
    <hr class="line">
    <table>
      <tr>
        <th class="text">Change Location:</th>
        <td>
          <select id="location" onchange="changeloc()">
            <option value="Syria">Syria</option>
            <option value="Uganda">Uganda</option>
            <option value="Tunisia">Tunisia</option>
          </select>
        </td>
      </tr>
      <tr>
         <td><p id="loc" class="text">This information is for Syria (current post)</p></td>
      </tr>
    </table>
  </div><!--closing div for location-->
  
  <!--Buttonf for each sub-feature-->
  <table id="btn-table">
  	<tr>
  	  <td>
  	    <button class="button" id="bt-PCMO" name="bt-PCMO" onclick="openPCMO()">Contact PCMO</button>
  	  </td>
  	  <td>
  	    <button class="button" id="bt-SSM" id="bt-SSM" name="bt-cnt-SSM" onclick="openSSM()">Contact SSM</button>
  	  </td>
  	</tr>
  	<tr align="center" id="tr-2">
  	  <td>
  	    <button class="button" id="bt-SARL" name="bt-SARL" onclick="openSARL()">Contact SARL</button>
  	  </td>
      <td>
        <a href="getHelpNow2.php">
          <img src="images/fw-arrow.png" style="height: 50px; width: 50px;">
        </a>
      </td>
  	</tr>
  </table>

  <!-- Popup for contact PCMO --> <style>p.indent{padding-right:3.8em}</style>  
  <div id="popup-PCMO" class="popup">
    <div class="popup-content">
      <span id="close-PCMO" class="close"><img src="images/close-button.png" style="height: 15px;width: 15px;"></span>
      <h3 class="text">Contact PCMO via</h3>
     <button style="text-indent:center; padding-right:3cm;" id="PCMO-call" class="popup-button" onclick="setnum(this.id)"> <i style="float:left; padding-left:3cm" class="w3-margin-left fa fa-phone fa-lg"></i> Voice Call</button>
      <button style="text-indent:center; padding-right:3cm;" id="PCMO-msg" class="popup-button" onclick="setnum(this.id)"><i style="float:left; padding-left:3cm" class="w3-margin-left fa fa-envelope fa-lg "></i>Send Message</button>
    </div>
  </div>

  <!-- Popup for contact SSM -->
  <div id="popup-SSM" class="popup">
    <div class="popup-content">
      <span id="close-SSM" class="close"><img src="images/close-button.png" style="height: 15px;width: 15px;"></span>
      <h3 class="text">Contact SSM via</h3>
     
      <button style="text-indent:center;  padding-right:3cm;" id="SSM-call" class="popup-button" onclick="setnum(this.id)"><i style="float:left; padding-left:3cm" class="w3-margin-left fa fa-phone fa-lg"></i>Voice Call </button>
      <button style="text-indent:center;  padding-right:3cm;" id="SSM-msg" class="popup-button" onclick="setnum(this.id)"><i  style="float:left; padding-left:3cm" class="w3-margin-left fa fa-envelope fa-lg"></i>Send Message</button>
    </div>
  </div>

  <!-- Popup for contact SARL -->
  <div id="popup-SARL" class="popup">
    <div class="popup-content">
      <span id="close-SARL" class="close"><img src="images/close-button.png" style="height: 15px;width:px;"></span>
      <h3 class="text">Contact SARL via</h3>
      <button style="text-indent:center;  padding-right:3cm;" id="SARL-call" class="popup-button" onclick="setnum(this.id)"><i style="float:left; padding-left:3cm" class="w3-margin-left fa fa-phone fa-lg"></i>Voice Call  </button>
      <button  style="text-indent:center;  padding-right:3cm;" id="SARL-msg" class="popup-button" onclick="setnum(this.id)"><i style="float:left; padding-left:3cm" class="w3-margin-left fa fa-envelope fa-lg"></i>Send Message</button>
    </div>
  </div>

</div><!--closing div for window-->
</center>
  <script type="text/javascript" src= "javascripts/changeloc.js"></script>
  <script type="text/javascript" src="javascripts/PCMOpopup.js"></script>
  <script type="text/javascript" src="javascripts/SSMpopup.js"></script>
  <script type="text/javascript" src="javascripts/SARLpopup.js"></script>
  <script type="text/javascript" src="javascripts/twilio-sms.js"></script>
  <script type="text/javascript" src="javascripts/twilio-call.js"></script>
  <script type="text/javascript" src="javascripts/gethelpnowPhNo.js"></script>
</body>
</html>