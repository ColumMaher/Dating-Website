<?php
session_start();
include("includes/browse_users_functions.inc.php");
include("connections.php");



if($_SERVER['REQUEST_METHOD'] === 'POST'){

  if($_POST['action'] == 'Send Like'){
      addLike($_SESSION['ID'], $_SESSION['openedUser'], $con);
      unset($_SESSION['openedUser']);
      ob_start();
      header('Location: Menu.php');
      ob_end_flush();
      die();
  }


}

$userId_Open = $_GET["id"];
$_SESSION['openedUser'] = $userId_Open;
// $userId_Open = 1;


$userDet = getUserDetails($userId_Open, $con);

$imgData = getImg($userId_Open, $con);
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
              <form action="OpenUser.php" method="post">
                <div class="form-row pt-5">
                  <div class="col-lg-10">
                    <input type="submit" name="action" value="Send Like" class="submitYes"> 
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