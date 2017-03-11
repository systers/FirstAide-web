<?php
/* 
   Created by Akanksha
   Desc: Welcome page - Displays recommended pages
*/
   if(!isset($_SESSION)){
     session_start();
   }
   if(!isset($_SESSION['email']))
   {  
      header("location: login.php"); 
   }
   else
     $_SESSION['welcomeopened'] = 1; //to prevent going back to progressBar(use in progressBar.php)
?>
<!DOCTYPE html>
<html>
<head>
  <title>FirstAide</title>
  <link rel="stylesheet" type="text/css" href="css files/welcome-style.css"/>
</head>
<body>
<?php
     include('menu.php');
?>
<center>
<div class="window">
  <div>
    <h1 class="text">Welcome to First Aide</h1>
    <hr class="line">
    <h2 class="text">Recommended Pages to Get Started</h2>
  </div>
  
  <table id="buttons-table">
  	<tr>
  	  <td>
  	    <button class="button" id="bt-safetystg" name="bt-safetystg">Safety Strategies Helpline</button>
  	  </td>
  	  <td>
  	    <button class="button" id="bt-helping" name="bt-helping">Helping a friend or Community member</button>
  	  </td>
  	</tr>
  	<tr>
  	  <td>
  	    <button class="button" id="bt-ghana" name="bt-ghana">Things to know before you travel to Ghana</button>
  	  </td>
  	  <td>
  	    <button class="button-org" id="bt-peerstng" name="bt-peerstng">
          Set your peer counselling preferences<img src="images/settings.png" style="height: 20px;width: 20px;" />
        </button>
  	  </td>
  	</tr>
  </table>
</div>
</center>
</body>
</html>
