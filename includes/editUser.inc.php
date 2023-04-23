<?php
session_start();
include("../connections.php");
include("uniChecker.inc.php");
include("browse_users_functions.inc.php");

$userId_LoggedIn = $_SESSION['ID'];
$userDet = getUserDetails($userId_LoggedIn, $con);


if($_FILES['img']['size'] != 0){
	echo "We enter here";
	//First Remove the og pic
	$imgData = getImg($userId_LoggedIn, $con);
	if(isset($imgData)){
		$imgSource = "../". $imgData["img_dir"] . $imgData["img_name"]; 
		//Delete the image
		unlink($imgSource);
	}




	//add the new image

	$Imgdir = "../img/pfp/";
	$fileName = rand(10,10000000) . basename($_FILES['img']['name']);
	$imgQuery = "UPDATE images set img_name = '$fileName' where userId = $userId_LoggedIn";
	if(!mysqli_query($con,$imgQuery)){
		echo("Error description: " . mysqli_error($con));
	}
	$targetFile = $Imgdir . $fileName;
	move_uploaded_file($_FILES['img']['tmp_name'], $targetFile);
}


$firstname = testValue($_POST['firstname'], $userDet['firstname']);
$lastname = testValue($_POST['lastname'], $userDet['lastname']);
$age =  $_POST['age'];
$city =  testValue($_POST['city'], $userDet['city']);
$bio = testValue($_POST['bio'], $userDet['bio']);
$uni =  universityChecker(testValue($_POST['uni'], $userDet['university']));
$job =  testValue($_POST['job'],$userDet['job']);
$hobbies =  testValue($_POST['hobbies'],$userDet['hobbies']);
$contact = testValue($_POST['contact'],$userDet['contact']);



$query = "UPDATE userdetails
SET firstname = '$firstname', lastname = '$lastname', 
age = $age, city = '$city', bio = '$bio',
university = '$uni', job = '$job',
hobbies = '$hobbies', contact = '$contact'
WHERE userId = $userId_LoggedIn;
";

if(!mysqli_query($con,$query)){
	echo("Error description: " . mysqli_error($con));
}

ob_start();
header('Location: ../Menu.php');
ob_end_flush();
die();
//Just for testing -- 
// echo $firstname;
// echo $lastname;
// echo $age;
// echo $city;
// echo $bio;
// echo $uni;
// echo $job;
// echo $hobbies;
// echo $contact;





function testValue($value, $default){
	if($value == "" || $value == null){
		return $default;
	}

	if (!preg_match('/[^A-Za-z]/', $value)) 
	{
  		return $value;
	}

	return $default;
}