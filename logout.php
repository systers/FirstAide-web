<?php
/*Created by Akanksha
  Desc: Called when logout tab of menu is clicked*/ 

  session_start();
  session_destroy();

  header('Location: login.php');//logout and go to login page 
?>