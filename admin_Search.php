<?php
session_start();
if(!isset($_SESSION['admin_user'])){
  header("location: index.php");
}



?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="style/userdetails.css">
    <link rel="icon" type="image/x-icon" href="images/website/icon.png">
	<title>Admin Search</title>
</head>
<body>
<div class="container ml-6 mt-5 mb-5">	
	<h1 class="heading">User Search</h1>
	<form class="row g-3" action="admin_FindUser.php" method="post">
		<div class="mt-5 col-md-12">
          <a href="admin_Menu.php">Return To Main Menu</a>
        </div>
		<div class="mt-5 mb-5 col-md-12">
			<label for="firstname" name="firstname" class="form-label">Username</label>
			<input type="text" class="form-control" id="username" name= "username" maxlength="30" required>
		</div>      

		<div class="mt-5 mb-5 col-md-12 text-center">
			<input type="submit" class = "submit"  name="action" value="Find User">
		</div>                  
	</form>
</div>

</body>
</html>