<?php
// session_start();
// $_SESSION['userCount'] = 0;
// echo "I see this";

// ob_start();
// header('Location: Login.php');
// ob_end_flush();
// die();
session_start();
if(isset($_COOKIE["Logged_In"])){
  $_SESSION['ID'] = $_COOKIE["Logged_In"];
  header("location: Menu.php");
  exit();
}

unset($_SESSION['admin_user']);


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <link rel="icon" type="image/x-icon" href="images/website/icon.png">
  <link rel="stylesheet" type="text/css" href="style/index.css">
  <title>Love Connect</title>
  </head>
  <body>
    <div class="container-fluid banner">
    	<div class="row">
    		<div class="col-md-12">
    			<nav class="navbar">
    			<div class="navbar-brand">
    				<img src="images/website/icon.png" alt="Logo" width="70" height="70">
    				Love Connect
    			</div>
    			<ul class="nav">
    				<li class="nav-item">
    					<a class="nav-link" href="Login.php">Login</a>
    				</li>
    			</ul>
    			</nav>
    		</div>
    		<div class="col-md-6 offset-md-3 info">
    			<h1 class="text-center">Love Connect</h1>
    			<p class="text-center">Connect with interesting people from different cities, and countries. Find people with the same unique hobbies as you!</p>
    			<form action="Register.php">
    				<input type="submit" class="submit" value="Get Connected!" name="Get Connected">
    			</form>
    		</div>
    </div>

  </body>
</html>
