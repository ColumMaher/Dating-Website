<?php
session_start();
include("includes/adminfunctions.inc.php");
include("connections.php");
if(!isset($_SESSION['admin_user'])){
  header("location: index.php");
  exit();
}


$time = $_POST['banTime'];

switch ($time) {
	case '1 Day':
		//																					1 day in seconds
		banUser($_SESSION['userId_Editing'], $con ,86400);
		break;
	case '3 Days':
		banUser($_SESSION['userId_Editing'], $con ,259200);
		break;
	case '1 Week':
		banUser($_SESSION['userId_Editing'], $con ,604800);
		break;
	case '1 Month':
		banUser($_SESSION['userId_Editing'], $con ,2419000);
		break;
	case 'Forever':
		banUser($_SESSION['userId_Editing'], $con ,0);
		break;
	case 'UnBan':
		unBanUser($_SESSION['userId_Editing'],$con);
		break;
	default:
		echo "Error: value not found";
		break;
}
header("location: AdminEditUser.php");
exit();