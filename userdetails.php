<?php
session_start();
include("includes/uniChecker.inc.php");
include("connections.php");
if(!isset($_SESSION['ID'])){
	ob_start();
	header('Location: index.php');
	ob_end_flush();
	die();
}
$Imgdir = "img/pfp/";
$fileName = rand(10,10000000) . basename($_FILES['img']['name']);
$targetFile = $Imgdir . $fileName;
//Need to add some checks for the file size

if ($_FILES['img']['size'] == 0 && $_FILES['fileToUpload']['error'] == 0){
	header("location: Userdetails.html?error=emptyField");
	exit();
}



move_uploaded_file($_FILES['img']['tmp_name'], $targetFile);
$UID = $_SESSION['ID'];
$firstname = validate($_POST['firstname']);
$lastname = validate($_POST['lastname']);
$gender = validate($_POST['gender']);
$age =  $_POST['age'];
$city =  validate($_POST['city']);
$bio = $_POST['bio'];
$uni =  universityChecker($_POST['uni']);
$job =  $_POST['job'];
$hobbies =  $_POST['hobbies'];
$interest = $_POST['interest'];
$contact = $_POST['contact'];



$query = "INSERT into userdetails (userId,firstname,lastname,gender,age,city,bio,university,job,hobbies,interests,contact) 
	values ('$UID', '$firstname', '$lastname','$gender',$age,'$city','$bio','$uni','$job','$hobbies','$interest','$contact');";

$imgQuery = "INSERT into images (userID, img_dir, img_name) values ($UID, '$Imgdir', '$fileName')";

if(!mysqli_query($con,$imgQuery)){
	echo("Error description: " . mysqli_error($con));
}

if(!mysqli_query($con,$query)){
	echo("Error description: " . mysqli_error($con));
}


ob_start();
header('Location: Menu.php');
ob_end_flush();
die();

//Just for testing -- 
echo $_POST['firstname'];
echo $_POST['lastname'];
echo $_POST['gender'];
echo $_POST['age'];
echo $_POST['city'];
echo $_POST['bio'];
echo $_POST['uni'];
echo $_POST['job'];
echo $_POST['hobbies'];
echo $_POST['interest'];


function validate($field){
	if(empty($field) || preg_match('/[^A-Za-z]/', $field)){
		header("location: Userdetails.html?error=invalidInput");
		exit();
	}else{
		return $field;
	}
}


