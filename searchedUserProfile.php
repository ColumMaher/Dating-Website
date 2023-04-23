<?php
session_start();
include("advancedSearch.php");
include("includes/browse_users_functions.inc.php");
include("connections.php");

$userId_LoggedIn = $_SESSION['ID'];
$userDet;
$imgData;
$imgSource;

if($_POST['action'] == 'Find User'){
    $firstname = $_POST['firstname'];
   $lastname = $_POST['lastname'];
   $userId = advancedSearch($firstname,$lastname,$con);
   if($userId['0'] != ""){
    $_SESSION['userSearched'] = $userId['0'];
    $userDet = getUserDetails($userId['0'], $con);
    $imgData = getImg($userId['0'], $con);
    if($imgData == null){
      $imgSource = "img/default/" . "default.png"; 
    }else{
      $imgSource = $imgData["img_dir"] . $imgData["img_name"]; 
    }
   }else{
      ob_start();
       header('Location: noUsers.html');
     ob_end_flush();
     die();
   }

}
//Check if the user has already been liked
$wasLiked = false;
$liked = likedUsers($userId_LoggedIn, $con);
if($liked){
  foreach($liked as $value){
    if($value == $_SESSION['userSearched']){
      $wasLiked = true;
      }
  }
}


if($_POST['action'] == 'Yes'){
  addLike($userId_LoggedIn, $_SESSION['userSearched'], $con);
  ob_start();
  header('Location: changePreferences.html');
  ob_end_flush();
  die();
}

if($_POST['action'] == 'No'){
  ob_start();
  header('Location: changePreferences.html');
  ob_end_flush();
  die();
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


          <div class="col-lg-5 pt-5 text-center">
            <img src="<?php echo $imgSource?>" class="img-fluid" alt="User Profile Picture" onerror=this.src="img/default/default.png">
            <h1><?php
            echo textStyle($userDet["firstname"]);?></h1>
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
              <form action="searchedUserProfile.php" method="post">
                <div class="form-row pt-5">
                  <div class="offset-1 col-lg-10">
                    <h3>Interested ?</h3>
                    <small><?php 
                      if($wasLiked == true){
                        echo "You have already liked this user!";
                      }
                    ?></small>
                  </div>
                  <div class="offset-1 col-lg-10">
                    <input type="submit" class = "submit" name="action" value="Yes">
                    <input type="submit" class = "submit" name="action" value="No">
                  </div>
                </div>
              </form>
              <div class="form-row pt-5">
                <div class="offset-1 col-lg-10">
                  <a href="changePreferences.html">
                    Return to Search
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