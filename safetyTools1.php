<?php
/*Created by Akanksha
  Desc: Navigation to features of safety tools (part 1)
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
  <link rel="shortcut icon" href="favicon.png" > //adding favicon
  <link rel="stylesheet" type="text/css" href="css files/safety-tools.css"/>
</head>
<body>
<?php
     include('menu.php');
?>
<center>
<div class="window">
  
  <div>
    <h1 class="text">Safety Tools</h1>
    <hr class="line">
  </div>

   <div id="fw-arrow">
    <a href="safetyTools2.php">
      <img src="images/fw-arrow.png" style="height: 50px; width: 50px;">
    </a>
  </div>
  <!--Navigation buttons-->
  <table id="btn-table">
    <tr>
      <td>
         <button class="button" onclick = "location.href='personalSecurityStrategies.php';" id="bt-personalstrategies" name="bt-personalstrategies">Personal Security Strategies</button>
      </td>
      <td>
        <button class="button" onclick = "location.href='radar.php';" id="bt-radar" name="bt-radar">RADAR</button>
      </td>
    </tr>
    <tr>
      <td>
        <button class="button" id="bt-coping" name="bt-coping" onclick = "location.href='copingWithUnwantedAttentionStrategies.php';" >Coping with unwanted Attention Strategies</button>
      </td>
      <td>
        <button class="button" id="bt-commonalities" name="bt-commonalities" onclick = "location.href='commonalitiesOfSexualPredators.php';" >Commonalities of Sexual Predators</button>
      </td>
    </tr>
  </table>
</div><!--closing div for window--> 
</center>
</body>
</html>
