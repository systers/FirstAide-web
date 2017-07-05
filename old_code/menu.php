<?php
/*Created by Akanksha
  Desc: Accordian side menu for the app
*/
  if(!isset($_SESSION))
    session_start();
  if(!isset($_SESSION['email']))
  {
    header("location:login.php");
  }
  else
  {
    $email=$_SESSION['email'];
    require 'dbconnect.php'; 
    $query = mysqli_query($connection,"CALL nameemail('$email')");
    $row = mysqli_fetch_row($query);
    $username=$row[0];
    mysqli_close($connection); 
  }
  
?>
<!DOCTYPE html>
<html>
<head>
    <title>FirstAide</title>
    <link rel="stylesheet" type="text/css" href="css files/menu-css.css"/>
</head>
<body>
<div id="accordian">
<ul class="ul-menu">
  <li>
    <h2><img src="images/PClogoWhite.png"/><a href="welcome.php">FirstAide</a></h2>
    <hr id="line">
    <h3><a href="getHelpNow.php">Get Help Now</a></h3>
    <h3><a href="circleOfTrust.php">Circle of Trust</a></h3>
  </li>
    <li>
      <h3 id="safetyTools">Safety Tools</h3>
      <ul class="ul-menu">
        <li><a href="safetyTools1.php">Safety Tools Main</a></li>
        <li><a href="personalSecurityStrategies.php">Personal Security Strategies</a></li>
        <li><a href="radar.php">RADAR</a></li>
        <li><a href="copingWithUnwantedAttentionStrategies.php">Coping with Unwanted Attention Startegies</a></li>
        <li><a href="commonalitiesOfSexualPredators.php">Commonalities of Sexual Predators</a></li>
        <li><a href="bystanderIntervention.php">Bystander Intervention</a></li>
        <li><a href="safetyPlanBasics.php">Safety Plan Basics</a></li>
        <li><a href="safetyPlanWorksheet.php">Safety Plan Worksheet</a></li>
      </ul>
    </li>
    <li>
      <h3 id="supportServices">Support Services</h3><!--Replace # with the php files-->
      <ul class="ul-menu">
        <li><a href="#">Support Services Main</a></li>
        <li><a href="#">Benefits of Seeking Staff Support</a></li>
        <li><a href="#">Available Services after a Sexual Assault</a></li>
        <li><a href="#">Peace Corps' Commitment to Victims of Sexual Assault</a></li>
        <li><a href="#">What to do After an Assault</a></li>
        <li><a href="#">Peace Corps Mythbusters:Assumptions and Facts</a></li>
      </ul>
    </li>
    <li>
      <h3 id="sexualAssaultAwareness">Sexual Assault Awareness</h3>
      <ul class="ul-menu">
        <li><a href="#">Sexual Assault Main</a></li>
        <li><a href="#">Was it Sexual Assault</a></li>
        <li><a href="#">Sexual Assault Common Questions</a></li>
        <li><a href="#">Impact of Sexual Assault</a></li>
        <li><a href="#">Sexual Harassment</a></li>
        <li><a href="#">Helping a Friend or Community Member</a></li>
      </ul>
    </li>
    <li>
      <h3 id="policyAndGlossary">Policies and Glossary</h3>
      <ul class="ul-menu">
        <li><a href="#">PeaceCorps Policy Summary Sheet</a></li>
        <li><a href="#">Glossary</a></li>
        <li><a href="#">Further Resources</a></li>
     </ul>
    <li>
       <h3>
          <a href="#">
           Settings <img src="images/settings.png" style="width: 20px;height: 20px; float:right;padding:5px;" />
          </a>
        </h3>
       <h3>
         <a href="#">
           Logged in as <img src="images/secure.png" style="width: 20px;height: 20px; float:right;padding:5px;" /><br><?php echo $username ?>
         </a>
       </h3>
       <h3>
         <a href="logout.php">Logout</a>
       </h3>
    </li>
</div>
  <script type="text/javascript" src="javascripts/js.cookie.js"></script>
  <script type="text/javascript" src="javascripts/jquery-1.12.4.min.js"></script>
  <script type="text/javascript" src="javascripts/menu.js"></script>  
</body>
</html>
