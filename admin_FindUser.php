<?php
session_start();
include("includes/functions.inc.php");
include("connections.php");
$username = $_POST['username'];

$userId = UidGet($con, $username);

$_SESSION['userId_Editing'] = $userId['userId'];
if(isset($_SESSION['userId_Editing'])){
	header("Location: AdminEditUser.php");
	exit();
}else{
	header("Location: Error/adminError.html");
	exit();
}
