<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
if(isset($_COOKIE["Logged_In"])){
  $_SESSION['ID'] = $_COOKIE["Logged_In"];
  header("location: Menu.php");
  exit();
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link rel="icon" type="image/x-icon" href="images/website/icon.png">
    <title>Login</title>
  </head>
  <body>
    <section class="login py-5 ">
      <div class="container">
        <div class="row">
          <div class="col-lg-5">
            <img src="images/website/hands.jpeg" class="img-fluid" alt="Website Logo">
          </div>          
          <div class="col-lg-7 text-center py-3">
            <h1>Login</h1>
            <form action="includes/login.inc.php" method="post">
              <div class="form-row py-3 pt-5">
                <div class="offset-1 col-lg-10">
                <input type="text" class="inp" name="usersId" placeholder="Enter Username" required
                oninvalid="this.setCustomValidity('Enter User Name Here')"
                oninput="this.setCustomValidity('')">
                <p><?php $error = $_GET['error']; if($error == "wronglogin"){echo "User Name Incorrect";}?></p>
                </div>
              </div>
              <div class="form-row">
                <div class="offset-1 col-lg-10">
                <input type="password" class="inp" name="pwd" placeholder="Enter Password" required
                oninvalid="this.setCustomValidity('Enter Password Here')"
                oninput="this.setCustomValidity('')">
                <p><?php $error = $_GET['error']; if($error == "wrongpassword"){echo "Incorrect Password";}?></p>
                </div>
              </div>
              <div class="form-row pt-5">
                <div class="offset-1 col-lg-10">
                  <button type="submit" name="submit" class="submit">Login</button>
                  <p><?php $error = $_GET['error']; if($error == "banned"){echo "User is Banned";}?></p>
                </div>
              </div>
              <div class="form-row pt-5">
                <div class="offset-1 col-lg-10">
                  <a href="Register.php">Register</a>
                </div>
              </div>
            </form>    
          </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>