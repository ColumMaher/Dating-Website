<?php

session_start();
session_unset();
session_destroy();
setcookie("Logged_In", null, -1, '/');
header("location: ../Login.php");
	exit();
?>
