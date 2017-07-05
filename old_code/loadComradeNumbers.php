<?php
/*Created by Akanksha
  Desc: Used to load numbers from db to the textboxes in editComrades.php file*/
   
    require 'dbconnect.php';
    if(!isset($_SESSION)){
        session_start(); 
    }
    if(!isset($_SESSION['email']))
   {  
      header("location: login.php"); 
   }
   $useremail = $_SESSION['email'];

   $dbphnos = array('','','','','','','');//intialize the array. 0th index will not be used (for ease of understanding and coding)

   for($i=1;$i<=6;$i++)
   {
      $result = mysqli_query($connection,"CALL getcomradenum('$useremail', $i)");//returns the phonenumber of comrade                         
      if($result->num_rows > 0)
      {
        while($row = mysqli_fetch_assoc($result))
        {
          $dbphnos[$i] = $row["phonenumber"];
        }
      }
      $connection -> next_result(); 
   }
   mysqli_close($connection);

?>

