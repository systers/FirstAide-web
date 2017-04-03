<?php
/*Created by Akanksha
  Desc: Personal Security Strategies of 'Safety tools'
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
    <h1 class="text">Personal Security Strategies</h1>
    <hr class="line">
  </div>
  <!--Add class="dragscroll" to any div whenever wrapped content is needed to have horizontal drag scroll-->
  <div class="dragscroll">
  <table class=""><!--add the class here according to the number of blocks to be used Example: greaterthan5-blocks-content if blocks are more than 5 ref:safety-tools.css-->
    <tr>
      <td class="block">
        Content yet to be provided..  
      </td>
      <td class="block">
        Content yet to be provided...
      </td>
    </tr>
  </table>
  </div>
</div>     
</center>
  <script type="text/javascript" src="javascripts/jquery-1.12.4.min.js"></script>
  <script type="text/javascript" src="dragscroll.js"></script>
</body>
</html>
