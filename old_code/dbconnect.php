<?php
/*Created by Akanksha
  Desc: Connection to mysql db for use in other files*/
    
    //change the credentials here according to the server used
	$username = "root";
	$password="";
	$hostname="localhost";
	$database="firstaide_web";
	$connection = mysqli_connect($hostname,$username,$password,$database)or die("Connection failed");
?>