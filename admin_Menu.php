<?php
//Check that the user is an admin
session_start();
if(!isset($_SESSION['admin_user'])){
  header("location: index.php");
}

unset($_SESSION['userId_Editing']);

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="style/userdetails.css">
    <link rel="icon" type="image/x-icon" href="images/website/icon.png">
    <title>Admin</title>
  </head>
  <body>

    <div class="container ml-6">
      <h1 class="text-center">Admin Menu</h1>
      <div class="row g-3 mt-5">

        <div class="mt-5 col-md-12 text-center">
          <a href="index.php">Logout</a>
        </div>

        <div class="mt-5 mb-5 col-md-12 text-center">
          <a href="admin_ViewUsers.php">All Users - Info / Ban status</a>
        </div> 

        <div class="mb-5 col-md-12 text-center">
          <a href="admin_Search.php">Search for a user</a>
        </div> 

                                        
      </div>
    </div>

  </body>
</html>