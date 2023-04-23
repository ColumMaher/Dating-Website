<?php
session_start();
include("includes/browse_users_functions.inc.php");
include("includes/adminfunctions.inc.php");
include("connections.php");

if(!isset($_SESSION['admin_user'])){
  header("location: index.php");
}
unset($_SESSION['userId_Editing']);
//The user that is logged in  11 to see all users
$userId_LoggedIn = 1;
// $userId_LoggedIn = 1;


$userids = getAllUserIds($con);

// $imgData = getImg($userId_LoggedIn, $con);
// if($imgData == null){
//   $imgSource = "img/default/" . "default.png"; 
// }else{
//   $imgSource = $imgData["img_dir"] . $imgData["img_name"]; 
// }



?>





<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style/user_style.css">
    <link rel="icon" type="image/x-icon" href="images/website/icon.png">
  <title>User</title>
  </head>
  <body>

      <h1 class="pt-3 text-center">
        <a href="admin_Menu.php">
          Admin Menu
        </a>
      </h1>




    <?php

      foreach ($userids as $value) {
        $userDet = getUserDetails($value, $con);
        $imgData = getImg($value, $con);
        if($imgData == null){
          $imgSource = "img/default/" . "default.png"; 
        }else{
          $imgSource = $imgData["img_dir"] . $imgData["img_name"]; 
        }
        echo "
      <section class='User py-5' id= 'User{$userDet["userId"]}'>
        <div class='container'>
          <div class='row'>


            <div class='col-lg-6 pt-5 text-center'>
              <img src='{$imgSource}' class='img-fluid' alt='User Profile Picture'>
              <h1>{$userDet["firstname"]}</h1>
              <h2>{$userDet["city"]}</h2>
              <h2>{$userDet["age"]}</h2>
              <p>{$userDet["job"]}</p>
            </div>

            <div class='col-lg-6 text-center py-3'>
              <div class='py-3 pt-5'>
                <div class='offset-1 col-lg-10'>
                  <p style='word-wrap:break-word'>{$userDet["bio"]}</p>
                </div>
              </div>
            ";

            echo "
              <div class='py-3 pt-5'>
                <div class='offset-1 col-lg-10'>
                  <h3>";

                    $arrayHobbies = groupHobbies($userDet["hobbies"]);
                    foreach ($arrayHobbies as $value) {
                      echo textStyle($value) . "    ";}
                  echo"
                  </h3>
                </div>
              </div>";



            echo"

            <div class='py-3'>
              <div class='offset-1 col-lg-10'>
                  <p>{$userDet["university"]}</p>
              </div>
            </div>   
            <form action='AdminEditUser.php' method='post'>
              <div class='form-row pt-5'>
                <div class='offset-1 col-lg-10'>
                  <input type='hidden' id='userId' name='userId' value='{$userDet['userId']}'>
                  <button type='submit' name='submit' class='submit'>Edit/Ban Profile</button>
                  <p>"; echo bannedText($userDet['userId'],$con);
                   echo"</p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>      
";

      }



    ?>
  </body>
</html>