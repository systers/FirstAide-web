<!--Created by Akanksha
    Desc: First page when app opened, displays logo and name of org and redirects to login after few seconds-->
<!DOCTYPE html>
<html>
<head>
    <title>FirstAide</title>
    <link rel="shortcut icon" href="favicon.png" > 
    <link rel="stylesheet" type="text/css" href="css files/index-style.css"/>
</head>
<body>
<center>
    <img src="images/PClogoWhite.png" style="width:200px; height:200px;float:left;"/>
    <h1 class="title">First Aide</h1>
</center>
</body>
<?php
    header("refresh:2;url=login.php");//redirect to login automatically after refreshing 2 times
?>
</html>
