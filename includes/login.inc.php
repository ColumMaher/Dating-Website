<?php 
	if (isset($_POST["submit"])) {
		
		$name = $_POST["usersId"];
		$pwd = $_POST["pwd"];
		
		$serverName = "localhost";
		$DBUserName = "root";
		$dBPassword = "";
		$dBName = "loveconnect";

		// $serverName = "sql108.epizy.com";
		// $DBUserName = "epiz_31203799";
		// $dBPassword = "siSrE7hjLok";
		// $dBName = "epiz_31203799_loveconnect";
		
		$conn = mysqli_connect($serverName, $DBUserName, $dBPassword, $dBName);

		if(!$conn){
			
			die("Error connecting to database: " . mysqli_connect_error());
			
		}
		
		require_once 'functions.inc.php';
		
		if (noInputLogin($name, $pwd) != false) {
			header("location: ../Login.php?error=emptyinput");
			exit();
		}
		loginUser($conn, $name, $pwd);
	}
	else {
		header("location: ../Login.php?error=dunno");
		exit();
	}
