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
$userDet;
$imgData;
$imgSource;

//The Yes or No Button are clicked
if($_SERVER['REQUEST_METHOD'] === 'POST'){

  if($_POST['action'] == 'Yes'){
    addLike($userId_LoggedIn, $_SESSION['userIds'][$_SESSION['BestuserCount']], $con);
  }
  if($_POST['action'] == 'No'){
    addNotInterested($userId_LoggedIn, $_SESSION['userIds'][$_SESSION['BestuserCount']], $con);
  }
  $_SESSION['BestuserCount'] = $_SESSION['BestuserCount'] + 1;

  if($_SESSION['BestuserCount'] >= $_SESSION['maxUsers']){
    header('Location: Error/noBestMatch.html');
    exit();
  }


  $userDet = getUserDetails($_SESSION['userIds'][$_SESSION['BestuserCount']], $con);
  $imgData = getImg($_SESSION['userIds'][$_SESSION['BestuserCount']], $con);
  if($imgData == null){
  $imgSource = "img/default/" . "default.png"; 
  }else{
    $imgSource = $imgData["img_dir"] . $imgData["img_name"]; 
  }



}else{
  //The page is loaded for the first time

  //All the Id's of users that the user logged in should be interested in
  $ids = bestMatch($userId_LoggedIn, $con);
  //print_r($ids);

  if(isset($_SESSION['userIds'])){
    //Session var ia already set - remove all vals + give it new ones
    unset($_SESSION['userIds']);
    $_SESSION['userIds'] = $ids;
  }else{
    //Session var is not set - so we set it
    $_SESSION['userIds'] = $ids;
  }

  $_SESSION['maxUsers'] = count($_SESSION['userIds']);
  if(empty($_SESSION['BestuserCount'])){
    $_SESSION['BestuserCount'] = 0;
  }
  if($_SESSION['BestuserCount'] >= $_SESSION['maxUsers']){
    header('Location: Error/noBestMatch.html');
    exit();
  }


  $userDet = getUserDetails($_SESSION['userIds'][$_SESSION['BestuserCount']], $con);
  $imgData = getImg($_SESSION['userIds'][$_SESSION['BestuserCount']], $con);

  if($imgData == null){
    $imgSource = "img/default/" . "default.png"; 
  }else{
    $imgSource = $imgData["img_dir"] . $imgData["img_name"]; 
  }
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
  <title>Best Match</title>
  </head>
  <body>
    <section class="User py-5">
      <div class="container">
        <div class="row">


          <div class="col-lg-6 pt-5 text-center">
            <img src="<?php echo $imgSource?>" class="img-fluid" alt="User Profile Picture" onerror=this.src="img/default/default.png">
            <h1><?php
            echo textStyle($userDet["firstname"]);?></h1>
            <label class="label">You are both from </label>
            <h2><?php echo textStyle($userDet["city"]) . " , " . $userDet["age"];?></h2>
            <p><?php echo textStyle($userDet["job"])?></p>
          </div>


          <div class="col-lg-6 text-center py-3">

              <div class="py-3 pt-5">
                <div class="col-lg-10">
                    <p style="word-wrap:break-word"><?php echo $userDet["bio"]?></p>
                </div>
              </div>



              <div class="py-3 pt-5">
                <div class="col-lg-10">
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
                  <small class="label">You both study at</small>
                  <p><?php echo textStyle($userDet["university"])?></p>
                </div>
              </div>   
              <form method="post" action="bestMatch.php">
                <div class="form-row pt-5">
                  <div class="col-lg-10">
                    <input type="submit" class = "submitYes" name="action" value="Yes">
                    <input type="submit" class = "submitNo" name="action" value="No">
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