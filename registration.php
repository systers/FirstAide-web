<!--Created by Akanksha
    Desc: Registration form and code to register the user
-->
<!DOCTYPE html>
<html>
<head>
  <title>FirstAide</title>
  <link rel="stylesheet" type="text/css" href="css files/loginAndRegistration.css">
  <link rel="stylesheet" href="css files/sweetalert.css">
  <form method="POST" onsubmit="return validate()" /><!--validations for form fields entered js file- validation-v12.js-->
</head>
<body>
<center>
  <div>
    <h1 class="text">First Aide</h1>
    <hr id="line">
    <h2 class="text">A Confidentiality Safety Resource for Peace Corps Volunteers</h2>
  </div>
  <!--form fields for registration-->
  <div class="div-reg">
    <table class="tables">
       <tr>
         <th class="text">Username:</th>
         <td><input class="input-box" type="text" id="uname" name="uname" placeholder="xyz123" required/></td>
       </tr>
        <tr>
         <th class="text" style="vertical-align: top">Password:</th>
         <td>
           <input class="input-box" type="password" id="password" name="password" required/>
           <div id="password-validation">
               <meter max="4" id="password-strength-meter"></meter>
               <p id="password-strength-text" class="text">Password Strength: Very Weak</p>
               <ul id="suggestion">
                   <li>at least one upper case letter</li>
                   <li>at least one number</li>
                   <li>at least one special character</li>
                   <li>minimum 6 characters long</li>
               </ul>
           </div>

         </td>
        <tr>
         <th class="text">Host Country:</th>
         <td><input class="input-box" type="text" id="host_country" name="host_country" placeholder="India" required/></td>
       </tr>
       <tr>
         <th class="text">Email:</th>
         <td><input class="input-box" type="text" id="email" name="email" placeholder="xyz@gmail.xom" required /></td>
       </tr>
    </table>
  </div>
  <!--submit button-->
  <div class="div-reg">
     <input class="button" type="submit" value="Create Account">
    <br><br>
    <img src="images/secure.png" style="width: 20px; height: 20px;"/>
    <a href="#">This is a secure portal</a>
  </div>
</center>
  <script src="javascripts/passwordStrengthChecker.js"></script>
  <script type="text/javascript" src="javascripts/validation-v12.js"></script>
  <script src="javascripts/sweetalert.min.js"></script>
  <script src="javascripts/sweetalert.js"></script>
</body>
</html>
<?php

   if(!isset($_SESSION))
     session_start();
   if(isset($_SESSION['email']))
   {
      header("location: welcome.php");
   }

   require 'dbconnect.php';

   if(isset($_POST['email'])&&isset($_POST['uname'])&&isset($_POST['password'])&&isset($_POST['host_country']))
   {
      $sql="CALL dupemail('$_POST[email]')";
      $result = mysqli_query($connection,$sql);
      $connection -> next_result(); //used when there are multiple procedure calls, use after ecah procedure call

      if(mysqli_num_rows($result)>=1) //check if it is a duplicate email
      {
         echo "<script type='text/javascript'>salert('Oops','User with this email already exists','error');</script>";
      }
      else
      {
        $email = $_POST['email'];
        $password = md5($password); // md5 encryption
        $newUser="CALL registration('$_POST[email]','$_POST[uname]','$_POST[password]','$_POST[host_country]')"; //inserts into the user table

        if(mysqli_query($connection,$newUser))
        {//if successfully added user then add comrades of user with null phone numbers
            $connection->next_result();
            for($i=1;$i<=6;$i++)
            {
              $addcomrade = "CALL addcomrade($i,'$email')";//adds comrades into comrade table
              mysqli_query($connection,$addcomrade);
              $connection->next_result();
            }
            echo "<script>salert('Success','Registered Successfully','success');
                   setTimeout(function () {
                   window.location.href = 'login.php';},2000);
                  </script>";
        }
        else
          echo "<script type='text/javascript'>salert('Oops','Error in adding user','error');</script>";
      }
      mysqli_close($connection);
   }

?>