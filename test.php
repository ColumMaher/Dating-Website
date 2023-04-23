<?php
session_start();
// include("includes/editUser.inc.php");
include("includes/browse_users_functions.inc.php");
include("connections.php");
//include("includes/functions.inc.php");

$userId_LoggedIn = 1;
$pref = getPreferences($userId_LoggedIn, $con);
 //All the Id's of users that the user logged in should be interested in
$ids = usersByPrefence($pref, $userId_LoggedIn,$con);
$_SESSION['ids'] = $ids;

print_r($_SESSION['ids']);
unset($_SESSION['ids']);

$pref2 = getPreferences(2, $con);
 //All the Id's of users that the user logged in should be interested in
$ids2 = usersByPrefence($pref2, 2,$con);
$_SESSION['ids'] = $ids2;

print_r($_SESSION['ids']);

// $imgName = $_FILES['img']['name'];
// $imgType = $_FILES['img']['type'];


// $Imgdir = "img/pfp/";
// $fileName = rand(10,10000000) . basename($_FILES['img']['name']);
// $targetFile = $Imgdir . $fileName;
// echo $targetFile;

//move_uploaded_file($_FILES['img']['tmp_name'], $targetFile);


// $pref = getPreferences(2, $con);


// $ids = usersByPrefence($pref, 6,$con);
// print_r($ids);


// echo testValue("132131", "Default");

// addLike(1,2, $con);

// $liked = notInterestedUsers(4,$con);
// print_r($liked);

// $banned = bannedUsers($con);
// print_r($banned);
// $hobbies = groupHobbies("running,swimming,cycling,minercaft");
// print_r($hobbies);