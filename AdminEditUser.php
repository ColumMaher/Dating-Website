<?php
session_start();
include("includes/browse_users_functions.inc.php");
include("includes/adminfunctions.inc.php");
include("connections.php");


if(!isset($_SESSION['admin_user'])){
  header("location: index.php");
}


//The user that is logged in - Get their details

if(!isset($_SESSION['userId_Editing'])){
  $userId_editing = $_POST['userId'];
  $_SESSION['userId_Editing'] = $userId_editing;
}else{
  $userId_editing = $_SESSION['userId_Editing'];
}

$userDet = getUserDetails($userId_editing, $con);
$username = getUsername($userId_editing, $con);
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="style/userdetails.css">
    <link rel="icon" type="image/x-icon" href="images/website/icon.png">
    <title>Edit Details</title>
  </head>
  <body>
    <div class="container ml-6">
      <h1 class="heading">Edit User - <?php echo $username["username"]?></h1>
      <form class="row g-3" action="includes/admin_editUser.inc.php"  method = "post" enctype="multipart/form-data">
        <div class="mt-5 col-md-12">
          <a href="admin_ViewUsers.php#User<?php echo $userId_editing; ?>">Return</a>
        </div>

        <div class="mt-5 col-md-6">
          <label for="username" class="form-label">Username</label>
          <input type="text" name= "username" class="form-control" id="username"  placeholder="<?php echo $username["username"]?>">
        </div>


        <div class="mt-5 col-md-6">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="password"  placeholder="">
        </div>

        <div class="mt-5 col-md-12 text-center">
          <label for="profilePic">Profile Picture</label>
          <input type="file" name="img" id="img" accept="image/*">
        </div>

        <div class="mt-5 col-md-6">
          <label for="firstname" class="form-label">Firstname</label>
          <input type="text" name= "firstname" class="form-control" id="firstname" maxlength="20" placeholder="<?php echo textStyle($userDet["firstname"])?>">
        </div>


        <div class="mt-5 col-md-6">
          <label for="lastname" class="form-label">Lastname</label>
          <input type="text" name="lastname" class="form-control" id="lastname" maxlength="20" placeholder="<?php echo textStyle($userDet["lastname"])?>">
        </div>

        <div class="mt-5 col-md-12">
          <label for="age">Age : <span id="demo"></label>
          <input type="range" class="form-control-range" name="age" id="myRange" min="18" max="99" value="<?php echo $userDet["age"]?>">
          <script>
            var slider = document.getElementById("myRange");
            var output = document.getElementById("demo");
            output.innerHTML = slider.value;

            slider.oninput = function() {
              output.innerHTML = this.value;
            }
          </script>
        </div>

        <div class="mt-5 col-md-6">
          <label for="city" name="city" class="form-label">City</label>
          <input type="text" class="form-control" id="city" name= "city" maxlength="60" placeholder="<?php echo textStyle($userDet["city"])?>">
        </div>      

        <div class="mt-5 col-md-6">
          <label for="uni" name="uni" class="form-label">University</label>
          <input type="text" class="form-control" id="uni" name= "uni" maxlength="60"
          placeholder="<?php echo textStyle($userDet["university"])?>">
        </div>

        <div class="mt-5 col-md-12">
          <label for="bio" name="uni" class="form-label">Bio</label>
          <textarea type="text" class="form-control" id="bio" name= "bio" maxlength="250" placeholder="<?php echo $userDet["bio"]?>"></textarea>
        </div>

        <div class="mt-5 col-md-12">
          <label for="job" name="job" class="form-label">Job</label>
          <input type="text" class="form-control" id="job" name= "job" maxlength="60" placeholder="<?php echo textStyle($userDet["job"])?>">
        </div>                      

        <div class="mt-5 col-md-12">
          <label for="hobbies" name="hobbies" class="form-label">Hobbies</label>
          <input type="text" class="form-control" id="hobbies" name= "hobbies" maxlength="100" placeholder="<?php echo $userDet["hobbies"]?>">
        </div> 


      <div class="mt-5 col-md-12">
        <label for="contact">Instagram</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text">@</div>
          </div>
          <input type="text" class="form-control" id="contact" name="contact" placeholder="<?php echo $userDet["contact"]?>">
        </div>
      </div>  

      <div class="mt-5 mb-5 col-md-12 text-center">
        <button type="submit" class="submit-button">Update Profile</button>
      </div> 

      </form>
    </div>



    <div class="container ml-6 mt-5 mb-5">
      <h1 class="heading">Ban User</h1>
       <form class="row g-3" action="Admin_BanUser.php"  method = "post">
        <?php $banned = bannedText($userId_editing,$con) ?>
        <div style="color: <?php if($banned == "UnBanned"){echo "#00ff00";} 
        else if($banned == "Temporarily Banned"){echo "orange";}else{echo "red";}?>;" class="mt-5 col-md-12">
          <p>User Ban Status: <?php echo $banned ?></p>
        </div>

        <div class="mt-5 col-md-12">
          <label for="banTime">Time Period</label>
          <select class="form-control" id="banTime" name="banTime">
            <option>1 Day</option>
            <option>3 Days</option>
            <option>1 Week</option>
            <option>1 Month</option>
            <option>Forever</option>
            <option>UnBan</option>
          </select>
        </div>

        <div class="mt-5 mb-5 col-md-12 text-center">
          <button type="submit" class="submit-button">Update</button>
        </div> 
       </form>
      
    </div>

  </body>
</html>