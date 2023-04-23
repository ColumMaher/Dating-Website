<?php
session_start();
include("includes/functions.inc.php");
include("includes/browse_users_functions.inc.php");
include("connections.php");


if(!isset($_SESSION['ID']) || isbanned($con, $_SESSION['ID'])){
  setcookie("Logged_In", null, -1, '/');
  ob_start();
  header('Location: index.php');
  ob_end_flush();
  die();
}

//The user that is logged in  11 to see all users
$userId_LoggedIn = $_SESSION['ID'];
// $userId_LoggedIn = 1;


$userDet = getUserDetails($userId_LoggedIn, $con);

$imgData = getImg($userId_LoggedIn, $con);
if($imgData == null){
  $imgSource = "img/default/" . "default.png"; 
}else{
  $imgSource = $imgData["img_dir"] . $imgData["img_name"]; 
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
    <link rel="stylesheet" type="text/css" href="style/user_style.css">
    <link rel="icon" type="image/x-icon" href="images/website/icon.png">
  <title>User</title>
  </head>
  <body>
    <section class="User py-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 pt-5 text-center">
            <img src="<?php echo $imgSource?>" class="img-fluid" alt="User Profile Picture">
            <h1><?php
            echo textStyle($userDet["firstname"]);?></h1>
            <h2><?php echo textStyle($userDet["city"]) . " , " . $userDet["age"];?></h2>
            <p><?php echo textStyle($userDet["job"])?></p>
          </div>


          <div class="col-lg-6 text-center py-3">

              <div class="py-3 pt-5">
                <div class="col-lg-10">
                  <small class="label">Bio:</small>
                    <p style="word-wrap:break-word"><?php echo $userDet["bio"]?></p>
                </div>
              </div>
             




              <div class="py-3 pt-5">
                <div class="col-lg-10">
                  <small class="label">Hobbies:</small>
                  <h4>
                    <?php 
                    $arrayHobbies = groupHobbies($userDet["hobbies"]);
                    foreach ($arrayHobbies as $value) {
                      echo textStyle($value) . "    ";
                   } 

                   ?>
                  </h4>
                </div>
              </div>


              <div class="py-3">
                <div class="col-lg-10">
                  <small class="label">Studying at:</small>
                  <p><?php echo textStyle($userDet["university"])?></p>
                </div>
              </div>   
              <form action="EditUser.php">
                <div class="form-row pt-5">
                  <div class="col-lg-10">
                    <button type="submit" name="submit" class="submit">Edit Profile</button>
                  </div>
                </div>
              </form>
              <div class="form-row pt-5">
                <div class="col-lg-10">
                  <a href="Menu.php">
                    Menu
                  </a>
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