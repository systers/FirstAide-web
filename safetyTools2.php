<?php
/*Created by Akanksha
  Desc: Navigation for features of safety tools(part2)
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

  <div id="bw-arrow">
    <a href="safetyTools1.php">
      <img src="images/bw-arrow.png" style="height: 50px; width: 50px;">
    </a>
  </div>
  <!--Navigation buttons-->
  <table id="btn-table">
  	<tr>
  	  <td>
  	    <button class="button" id="bt-bystander" name="bt-bystander" onclick="location.href='bystanderIntervention.php';">Bystander Intervention</button>
  	  </td>
  	  <td>
  	    <button class="button" id="bt-safetyBasic" name="bt-safetyBasic" onclick="location.href='safetyPlanBasics.php';">Safety Plan Basics</button>
  	  </td>
  	</tr>
  	<tr align="center" id="tr-2" colspan="2">
  	  <td>
  	    <button class="button" id="bt-safetyWorksheet" name="bt-safetyWorksheet" onclick="location.href='safetyPlanWorksheet.php';">Safety Plan Worksheet</button>
  	  </td>
  	</tr>
  </table>
</div><!--closing div for window-->
</center>
</body>
</html>
