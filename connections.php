<?php
//Local
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "loveconnect";

// $dbhost = "sql108.epizy.com";
// $dbuser = "epiz_31203799";
// $dbpass = "siSrE7hjLok";
// $dbname = "epiz_31203799_loveconnect";


if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){
	die("failed to connect!");
}