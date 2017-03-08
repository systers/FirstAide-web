<!--Created by Akanksha
    Desc : Login form and also code for checking validating login credentials
-->
<!DOCTYPE html>
<html>
<head>
  <title>FirstAide</title>
  <link rel="stylesheet" type="text/css" href="css files/loginAndRegistration.css">
  <link rel="stylesheet" href="css files/sweetalert.css">
  <form method="POST"/>
</head>
<body>
<center>
  <div>
    <h1 class="text">First Aide</h1>
    <hr id="line">
    <h2 class="text">A Confidentiality Safety Resource for Peace Corps Volunteers</h2>
  </div>
  <!--form for login-->
  <div class="div">
  <table class="tables">
    <tr>
        <th class="text">Email:</th>
         <td><input class="input-box" type="text" id="email" name="email" required/></td>
       </tr>
        <tr>
         <th class="text">Password:</th>
         <td><input class="input-box" type="password" id="password" name="password" required/></td>
       </tr>
  </table>
    <input type="checkbox" name="keep">
         <label class="text">Keep me logged in</label>
  </div>

  <div class="div">
       <input class="button" type="submit" id="submit" value="Sign in to Account">
    <br><br>
    <a href="registration.php">Create Account Here</a>
  </div>
</center>

<script src="javascripts/sweetalert.min.js"></script>
<script src="javascripts/sweetalert.js"></script>

</body>
</html>
<?php

   if(!isset($_SESSION))
     session_start(); 
   if(isset($_SESSION['email']) && isset($_COOKIE['email']))
   {  
     header("location: welcome.php"); 
   }
   
   require 'dbconnect.php'; 
   if (isset($_POST['email'])&&isset($_POST['password'])&&!empty($_POST['email'])&&!empty($_POST['password'])) 
   {
      //Prevent MYSQL Injection, added security
      $email = mysqli_real_escape_string($connection, $_POST['email']);
      $password = mysqli_real_escape_string($connection, $_POST['password']);
      $email = stripslashes($email);
      $password = stripslashes($password);
      $check = isset($_POST['keep']);

      //Match given password with the saved one in db
      $query = mysqli_query($connection,"CALL login('$password','$email')");
      $rows = mysqli_num_rows($query);
       if ($rows == 1) //password is correct
       {
          $_SESSION['email']=$email; 
          if ($check == 'on') 
          {
            setcookie('email', $email, time()+3600);
          }
          header("location: progressBar.php"); 
       }
       else 
       {
        echo "<script type='text/javascript'>salert('Invalid email or password','Enter again','error');</script>";
       }
       mysqli_close($connection); 
    }
?>