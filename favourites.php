<?php
session_start();
include("includes/browse_users_functions.inc.php");
include("includes/functions.inc.php");
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


//Next
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  if($_POST['action'] == 'Next'){
    $_SESSION['userLiked'] = $_SESSION['userLiked'] + 1;
  }
}


//Get likes
$liked = likedUsers($userId_LoggedIn, $con);
// print_r($ids);
$maxUsers = count($liked); // Amount of users found based off the preferences give

if($maxUsers == 0){
  ob_start();
  header('Location: Error/noFavs.html');
  ob_end_flush();
  die();
}


if(empty($_SESSION['userLiked'])){
    $_SESSION['userLiked'] = 0;
}
if($_SESSION['userLiked'] >= $maxUsers){
    $_SESSION['userLiked'] = 0;
}

// echo $_SESSION['userCount'];


$userDet = getUserDetails($liked[$_SESSION['userLiked']], $con);

$imgData = getImg($liked[$_SESSION['userLiked']], $con);
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
  <title>Favourites</title>
  </head>
  <body>
    <section class="User py-5">
      <div class="container">
        <div class="row">


          <div class="col-lg-6 pt-5 text-center">
            <img src="<?php echo $imgSource?>" class="img-fluid" alt="User Profile Picture"
            onerror=this.src="img/default/default.png">
            <h1><?php
            echo textStyle($userDet["firstname"]);?></h1>
            <h2><?php echo textStyle($userDet["city"]) . " , " . $userDet["age"];?></h2>
            <p><?php echo textStyle($userDet["job"])?></p>
          </div>


          <div class="col-lg-6 text-center py-3">

              <div class="py-3 pt-5">
                <div class="col-lg-10">
                  <label class="label">Bio:</label>
                    <p style="word-wrap:break-word"><?php echo $userDet["bio"]?></p>
                </div>
              </div>



              <div class="py-3 pt-5">
                <div class="col-lg-10">
                  <label class="label">Hobbies:</label>
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
                  <label class="label">Studying at</label>
                  <p><?php echo textStyle($userDet["university"])?></p>
                </div>
              </div>   
              <form method="post" action="favourites.php">
                <div class="form-row pt-5">
                  <div class="col-lg-10">
                    <input type="submit" name="action" class="submit" value="Next">
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