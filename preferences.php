<?php
session_start();
include("connections.php");
include("includes/uniChecker.inc.php");
$userId_LoggedIn = $_SESSION['ID'];


$gender = ($_POST['gender']);
$hobbies = $_POST['hobbies'];
$uni = universityChecker($_POST['uni']);
$city = $_POST['city'];
$age_low =  $_POST['age_from'];
$age_high =  $_POST['age_to'];

if(!userPreferencesEntered($con,$userId_LoggedIn)){
	$queryUpdate = "insert into userpreferences (userId,gender,hobbies,university,city,age_high,age_low) 
	values ('$userId_LoggedIn', '$gender', '$hobbies','$uni','$city',$age_high,$age_low);";
	if(!mysqli_query($con,$queryUpdate)){
	//header("Location : error.html");
		echo("Error description: " . mysqli_error($con));
	}

}else{
	$query = "UPDATE userpreferences set gender = '$gender' , 
	hobbies = '$hobbies', university = '$uni', city = '$city', 
	age_high = $age_high, age_low = $age_low where userId = $userId_LoggedIn";
	if(!mysqli_query($con,$query)){
	//header("Location : error.html");
		echo("Error description: " . mysqli_error($con));
	}
}



// echo $gender;
// echo $hobbies;
// echo $uni;
// echo $city;
// echo $age_low;
// echo $age_high;



ob_start();
header('Location: BrowseUser.php');
ob_end_flush();
die();





function userPreferencesEntered($conn, $userId_LoggedIn){
	$query = "SELECT userId FROM userpreferences where userId = $userId_LoggedIn";
	$userIdArray = []; 
	if ($stmt = $conn->prepare($query)) {

	    $stmt->execute();

	    $stmt->bind_result($userId);

	    while ($stmt->fetch()) {
	    	array_push($userIdArray, $userId);
	    }
	    $stmt->close();
	}
	if(empty($userIdArray)){
		return false;
	}else{

		return true;
	}
}

//Testing purposes 

