<?php
include("includes/browse_users_functions.inc.php");
include("includes/functions.inc.php");
include("connections.php");
session_start();
if(!isset($_SESSION['ID']) || isbanned($con, $_SESSION['ID'])){
  setcookie("Logged_In", null, -1, '/');  
  ob_start();
  header('Location: index.php');
  ob_end_flush();
  die();
}
$_SESSION['userCount'] = 0;
$_SESSION['BestuserCount'] = 0;
$userId_LoggedIn = $_SESSION['ID'];


?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="MainMenuStyle.css">
<title>Menu</title>
</head>
<body>

<!--
<div class="banner">
  <img class="banner-image" src="C:\Users\35386\OneDrive\Desktop\Year 3\CS4116\images\banner.jpg">
<div class="banner--fadeBottom"></div>
</div>  -->

<div class="banner">
  <div class="banner__contents">
    <h1 class="banner__title">Love Connect </h1>
  </div>
  <div class="banner--fadeBottom"></div>
</div>


<div id="mySidenav" class="sidenav">

  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="UserProfile.php">My Profile</a>
  <a href="BrowseUser.php">Browse Users</a>
  <a href="changePreferences.html">Search</a>
  <a href="match.php">View Matches</a>
  <a href="EditUser.php">Edit Profile</a>
  <a href="favourites.php">Favourites</a>
  <a href="bestMatch.php">Best Match</a>
  <a href="includes/logout.inc.php">Log Out</a>
</div>

<div id="main">
  <span style="font-size:30px;cursor:pointer; color: white" onclick="openNav()">&#9776; Menu</span>
</div>
    


    <!--Browse Users-->
<div class="row">
    <h2>BROWSE ALL USERS</h2>
    <div class="row_posters">
<?php 
//All users from the db
$query = "SELECT userId from userdetails";
$userIdArray = []; 
if ($stmt = $con->prepare($query)) {

    /* execute statement */
    $stmt->execute();

    /* bind result variables */
    $stmt->bind_result($userId);

        /* fetch values */
    while ($stmt->fetch()) {
        array_push($userIdArray, $userId);
            //printf ("%s\n", $userId);
    }

        /* close statement */
    $stmt->close();
}
//Remove the user logged in ID
removeId($userId_LoggedIn, $userIdArray);

    //Remove all banned users, liked users
$bannedUsers = bannedUsers($con);
$likedUsers = likedUsers($userId_LoggedIn, $con);


//Get rid of all the banned users
if($bannedUsers){
    removeIdArray($bannedUsers, $userIdArray);
}
//Get rid of all the liked users
if($likedUsers){
    removeIdArray($likedUsers, $userIdArray);
}
//Re-order the array
if(count($userIdArray) > 15){
    $userIds = array_slice(array_values($userIdArray), 0, 15);
}else{
    $userIds = array_values($userIdArray);
}

shuffle($userIds);


//First 10 users




    foreach($userIds as $value){
        $imgData = getImg($value, $con);
        if($imgData == null){

            //Default image is used if the user doesnt have a profile pic
            $finalImg = "img/default/" . "default.png"; 
        }else{
            $finalImg = $imgData["img_dir"] . $imgData["img_name"]; 
        }



?>


        <a href="OpenUser.php?id=<?php echo $value; ?>">
        <img src="<?php echo $finalImg; ?>" alt="user image" class="row_poster row_posterLarge" width="100" height="100">
        </a>
<?php } ?>


    </div>
</div>



    <!--Liked Users-->
<div class="row">
    <h2>MY LIKED USERS</h2>
    <div class="row_posters">
<?php 
$userIdLiked = likedUsers($userId_LoggedIn, $con);
//Re-order the array
if(count($userIdLiked) > 15){
    $userIds = array_slice(array_reverse(array_values($userIdLiked)), 0, 15);
}else{
    $userIds = array_reverse(array_values($userIdLiked));
}




//First 10 users




    foreach($userIds as $value){
        $imgData = getImg($value, $con);
        if($imgData == null){

            //Default image is used if the user doesnt have a profile pic
            $finalImg = "img/default/" . "default.png"; 
        }else{
            $finalImg = $imgData["img_dir"] . $imgData["img_name"]; 
        }



?>



        <img src="<?php echo $finalImg; ?>" alt="user image" class="row_poster row_posterLarge" width="100" height="100">
        
<?php } ?>


    </div>
</div>







<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "white";
}

function viewMatches(){


}


</script>
   
</body>
</html> 
