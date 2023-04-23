<?php

function noInputSignup($name, $pwd, $pwd_confirm) {
	$return;
	if (empty($name) || empty($pwd) || empty($pwd_confirm)) {
		$return = true;
	}
	else {
		$return = false;
	}
	return $return;
}
function invalidUid($name) {
	$return;
	//filter_var($email, FILTER_VALIDATE_EMAIL) <- if we add emails to be 
	if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
		$return = true;
	}
	else {
		$return = false;
	}
	return $return;
}
function pwdCon($pwd, $pwd_confirm) {
	$return;
	
	if ($pwd !== $pwd_confirm) {
		$return = true;
	}
	else {
		$return = false;
	}
	return $return;
}
function UidExists($conn, $name) {
	
	$sql = "SELECT * FROM users WHERE username = ?;";//Add OR usersEmail = ? if looking for email
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../Login.php?error=stmtfailed");
		exit();
	}
	
	mysqli_stmt_bind_param($stmt, "s", $name);
	mysqli_stmt_execute($stmt);
	
	$resultData = mysqli_stmt_get_result($stmt);
	
	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}
	else {
		$result = false;
		return $result;
	}
	
	mysqli_stmt_close($stmt);
}

function pwdGet($conn, $name) {
	
	$sql = "SELECT password FROM users WHERE username = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../Login.php?error=stmtfailed");
		exit();
	}
	
	mysqli_stmt_bind_param($stmt, "s", $name);
	mysqli_stmt_execute($stmt);
	
	$resultData = mysqli_stmt_get_result($stmt);
	
	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}
	else {
		$result = false;
		return $result;
	}
	
	mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $pwd) {
	
	$sql = "INSERT INTO users (username, password) VALUES (?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../Register.php?error=stmtfailed2");
		exit();
	}
	
	$hashedpwd = password_hash($pwd, PASSWORD_BCRYPT);
	
	mysqli_stmt_bind_param($stmt, "ss", $name, $hashedpwd);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header("location: ../Login.php");
	exit();
}
function noInputLogin($name, $pwd) {
	$return;
	if (empty($name) || empty($pwd)) {
		$return = true;
	}
	else {
		$return = false;
	}
	return $return;
}
function UidGet($conn, $name){
	$sql = "SELECT userId FROM users WHERE username = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../Login.php?error=IDgetfailed");
		exit();
	}
	
	mysqli_stmt_bind_param($stmt, "s", $name);
	mysqli_stmt_execute($stmt);
	
	$resultData = mysqli_stmt_get_result($stmt);
	
	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}
	else {
		$result = false;
		return $result;
	}
	
	mysqli_stmt_close($stmt);
}
//Query user details to see if they are already set
function userDetailsEntered($conn, $userId_LoggedIn){
	$query = "SELECT userId FROM userdetails where userId = $userId_LoggedIn";
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


function loginUser($conn, $name, $pwd){
	
	$uidExists = UidExists($conn, $name);//Add another id parameter for email if login using email
	$passCheck = pwdGet($conn, $name);
	
	if ($uidExists == false) {
		header("location: ../Login.php?error=wronglogin");
		exit();
	}
	$pwdHashed = $passCheck;
	$checkPwd = password_verify($pwd,$pwdHashed["password"]);
	
	if ($checkPwd == false) {
		header("location: ../Login.php?error=wrongpassword");
		exit();
	}

	else if ($checkPwd == true) {
		session_start();
		$UID = UidGet($conn, $name);
		if (isAdmin($conn, $UID['userId'])) {
			header("location: ../admin_Menu.php");
			//admin user is logged in, just set the session variable 
			$_SESSION['admin_user'] = 1;
			exit();
		}else{
			if (isbanned($conn, $UID['userId'])) {
				header("location: ../Login.php?error=banned");
				exit();
			}
			$_SESSION['ID'] = $UID['userId'];
			$cookie_name = "Logged_In";
			$cookie_value = $UID['userId'];
			setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
			//Check to see if user details have been filled out already
			if(userDetailsEntered($conn,$_SESSION['ID'])){
				header("location: ../Menu.php");
				exit();
			}else{
				header("location: ../Userdetails.html"/* .$_SESSION['ID'] */);
				exit();
			}
		}
	}
}

function isAdmin($conn , $userId){
	$query = "SELECT isAdmin FROM users WHERE userId = $userId";
	$admin = [];
	if($stmt = $conn->prepare($query)){
		$stmt->execute();
		$stmt->bind_result($isAdmin);
		while($stmt->fetch()){
			array_push($admin, $isAdmin);
		}
		$stmt->close();
	}
	return $admin[0];
}

function isbanned( $con , $userId){
	$ts = time();
	$query = "SELECT * FROM banned where userId = $userId";
	$result = mysqli_query($con, $query);
	if (mysqli_num_rows($result) > 0) {
 		$banned = mysqli_fetch_assoc($result);
 		if($banned['time'] == 0){
 			return true;
 		}else if($banned['time'] < $ts){
 			//Ban has expired 
 			removeBan($con, $userId);
 			return false;
 		}else{
 			return true;
 		}
	}else{
		return false;
	}
}

function removeBan($con, $userId){
	$query = "DELETE FROM banned WHERE userId = $userId";

	if(!mysqli_query($con,$query)){
		echo("Error description: " . mysqli_error($con));
	}
}
