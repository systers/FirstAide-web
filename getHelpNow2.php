<?php
/*Created by Akanksha
  Desc: Form to navigate to PCSaves, Office of victim advocacy, Ofiice of inspector general and Office of civil rights and services
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
  <link rel="shortcut icon" href="favicon.png" > 
  <link rel="stylesheet" type="text/css" href="css files/gethelpnow-style.css"/>
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
  </div>

  <div id="bw-arrow">
    <a href="getHelpNow.php">
      <img src="images/bw-arrow.png" style="height: 50px; width: 50px;">
    </a>
  </div>
  <!--Navigate buttons-->
  <div id="div1">
  <table id="btn-table">
    <tr>
      <td>
         <button class="button" onclick = "location.href='PCSaves.php';" id="bt-PCSaves" name="bt-PCSaves">PC Saves Anonymous Helpline</button>
      </td>
      <td>
        <button class="button" onclick = "location.href='officeOfVictimAdvocacy.php';" id="bt-offVA" name="bt-offVA">Office of Victim Advocacy</button>
      </td>
    </tr>
    <tr>
      <td>
        <button class="button" id="bt-offIG" name="bt-offIG" onclick = "location.href='officeOfInspectorGeneral.php';" >Office of Inspector General</button>
      </td>
      <td>
        <button class="button" id="bt-offCRD" name="bt-offCRD" onclick = "location.href='officeOfCivilRightsAndDiversity.php';" >Office of Civil Rights and Diversity</button>
      </td>
    </tr>
  </table>
  </div>
</div>     
</center>
</body>
</html>
