<?php
session_start();
include("includes/browse_users_functions.inc.php");
include("connections.php");


//The user that is logged in  11 to see all users
$userId_LoggedIn = $_SESSION['ID'];


//Next
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  if($_POST['action'] == 'Next'){
    $_SESSION['userMatch'] = $_SESSION['userMatch'] + 1;
  }
}


//Get likes
$matches = userMatches($userId_LoggedIn, $con);
// print_r($ids);
$maxUsers = count($matches); // Amount of users found based off the preferences give

if($maxUsers == 0){
  ob_start();
  header('Location: Error/noMatches.html');
  ob_end_flush();
  die();
}


if(empty($_SESSION['userMatch'])){
    $_SESSION['userMatch'] = 0;
}
if($_SESSION['userMatch'] >= $maxUsers){
    $_SESSION['userMatch'] = 0;
}

// echo $_SESSION['userCount'];


$userDet = getUserDetails($matches[$_SESSION['userMatch']], $con);

$imgData = getImg($matches[$_SESSION['userMatch']], $con);
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
  <title>Matches</title>
  </head>
  <body>
    <section class="User py-5">
      <div class="container">
        <div class="row">


          <div class="col-lg-5 pt-5 text-center">
            <img src="<?php echo $imgSource?>" class="img-fluid" alt="User Profile Picture"
            onerror=this.src="img/default/default.png">
            <h1><?php
            echo textStyle($userDet["firstname"]) . " " . textStyle($userDet["lastname"]);?></h1>
            <h2><?php echo textStyle($userDet["city"]) . " , " . $userDet["age"];?></h2>
            <p><?php echo textStyle($userDet["job"])?></p>
          </div>


          <div class="col-lg-7 text-center py-3">

              <div class="py-3 pt-5">
                <div class="offset-1 col-lg-10">
                    <p style="word-wrap:break-word"><?php echo $userDet["bio"]?></p>
                </div>
              </div>



              <div class="py-3 pt-5">
                <div class="offset-1 col-lg-10">
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
                <div class="offset-1 col-lg-10">
                  <p><?php echo textStyle($userDet["university"])?></p>
                </div>
              </div>  

              <div class="py-3">
                <div class="offset-1 col-lg-10">
                  <h3>Get In Contact: </h3>
                  <h3><a href="https://www.instagram.com/<?php echo textStyle($userDet["contact"])?>/?hl=en" target="_blank">Instagram</a></h3>
                </div>
              </div>                  
              <form method="post" action="match.php">
                <div class="form-row pt-5">
                  <div class="offset-1 col-lg-10">
                    <input type="submit" name="action" class="submit" value="Next">
                  </div>
                </div>
              </form>
              <div class="form-row pt-5">
                <div class="offset-1 col-lg-10">
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